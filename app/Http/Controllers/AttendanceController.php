<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Murid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();
        $scheduleId = $request->schedule_id;
        
        $user = Auth::user();
        
        if ($user->isSuperAdmin() || $user->isTataUsaha()) {
            // Admin dan tata usaha dapat melihat semua kehadiran
            $query = Attendance::with(['murid', 'schedule', 'markedBy']);
            
            if ($scheduleId) {
                $query->where('schedule_id', $scheduleId);
            }
            
            $attendances = $query->where('date', $date->format('Y-m-d'))->paginate(15);
            $schedules = Schedule::where('status', 'active')->get();
        } elseif ($user->isGuru()) {
            // Guru hanya melihat kehadiran untuk jadwal yang mereka ajar
            $guru = $user->guru;
            if (!$guru) {
                return redirect()->route('dashboard')
                    ->with('error', 'Profil guru tidak ditemukan');
            }
            
            $schedules = Schedule::where('guru_id', $guru->id)
                ->where('status', 'active')
                ->get();
                
            $scheduleIds = $schedules->pluck('id')->toArray();
            
            $query = Attendance::with(['murid', 'schedule', 'markedBy'])
                ->whereIn('schedule_id', $scheduleIds);
                
            if ($scheduleId && in_array($scheduleId, $scheduleIds)) {
                $query->where('schedule_id', $scheduleId);
            }
            
            $attendances = $query->where('date', $date->format('Y-m-d'))->paginate(15);
        } else {
            // Murid hanya melihat kehadiran mereka sendiri
            $murid = $user->murid;
            if (!$murid) {
                return redirect()->route('dashboard')
                    ->with('error', 'Profil murid tidak ditemukan');
            }
            
            $attendances = Attendance::with(['schedule', 'markedBy'])
                ->where('murid_id', $murid->id)
                ->where('date', $date->format('Y-m-d'))
                ->paginate(15);
                
            $schedules = $murid->schedules()->where('status', 'active')->get();
        }
        
        return view('attendances.index', compact('attendances', 'schedules', 'date', 'scheduleId'));
    }

    /**
     * Show form to take attendance for a schedule on a specific date.
     */
    public function create(Request $request)
    {
        $scheduleId = $request->schedule_id;
        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();
        
        if (!$scheduleId) {
            return redirect()->route('attendances.index')
                ->with('error', 'Jadwal harus dipilih');
        }
        
        $schedule = Schedule::with('murids')->findOrFail($scheduleId);
        
        // Check if user is authorized to take attendance for this schedule
        $user = Auth::user();
        if ($user->isGuru()) {
            $guru = $user->guru;
            if (!$guru || $schedule->guru_id != $guru->id) {
                return redirect()->route('attendances.index')
                    ->with('error', 'Anda tidak berwenang mengisi absensi untuk jadwal ini');
            }
        } elseif (!$user->isSuperAdmin() && !$user->isTataUsaha()) {
            return redirect()->route('attendances.index')
                ->with('error', 'Anda tidak berwenang mengisi absensi');
        }
        
        // Get existing attendance records for this schedule and date
        $existingAttendances = Attendance::where('schedule_id', $scheduleId)
            ->where('date', $date->format('Y-m-d'))
            ->get()
            ->keyBy('murid_id');
        
        return view('attendances.create', compact('schedule', 'date', 'existingAttendances'));
    }

    /**
     * Store attendance records for multiple students.
     */
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.murid_id' => 'required|exists:murids,id',
            'attendances.*.status' => 'required|in:present,absent,late,sick,permission',
            'attendances.*.notes' => 'nullable|string',
        ]);
        
        $scheduleId = $request->schedule_id;
        $date = $request->date;
        $userId = Auth::id();
        
        foreach ($request->attendances as $attendance) {
            Attendance::updateOrCreate(
                [
                    'schedule_id' => $scheduleId,
                    'murid_id' => $attendance['murid_id'],
                    'date' => $date,
                ],
                [
                    'status' => $attendance['status'],
                    'notes' => $attendance['notes'] ?? null,
                    'marked_by' => $userId,
                ]
            );
        }
        
        return redirect()->route('attendances.index', ['schedule_id' => $scheduleId, 'date' => $date])
            ->with('success', 'Absensi berhasil disimpan');
    }

    /**
     * Display attendance report.
     */
    public function report(Request $request)
    {
        $month = $request->month ? Carbon::parse($request->month . '-01') : Carbon::today()->startOfMonth();
        $scheduleId = $request->schedule_id;
        $muridId = $request->murid_id;
        
        $user = Auth::user();
        
        // Prepare data based on user role
        if ($user->isSuperAdmin() || $user->isTataUsaha()) {
            $schedules = Schedule::where('status', 'active')->get();
            $murids = Murid::where('record_flag', 'active')->get();
        } elseif ($user->isGuru()) {
            $guru = $user->guru;
            if (!$guru) {
                return redirect()->route('dashboard')
                    ->with('error', 'Profil guru tidak ditemukan');
            }
            
            $schedules = Schedule::where('guru_id', $guru->id)
                ->where('status', 'active')
                ->get();
                
            $scheduleIds = $schedules->pluck('id')->toArray();
            $muridIds = [];
            
            foreach ($schedules as $schedule) {
                $muridIds = array_merge($muridIds, $schedule->murids->pluck('id')->toArray());
            }
            
            $murids = Murid::whereIn('id', array_unique($muridIds))
                ->where('record_flag', 'active')
                ->get();
        } else {
            $murid = $user->murid;
            if (!$murid) {
                return redirect()->route('dashboard')
                    ->with('error', 'Profil murid tidak ditemukan');
            }
            
            $schedules = $murid->schedules()->where('status', 'active')->get();
            $murids = collect([$murid]);
            $muridId = $murid->id;
        }
        
        // Build query based on filters
        $query = Attendance::query();
        
        if ($scheduleId) {
            $query->where('schedule_id', $scheduleId);
        } elseif ($user->isGuru() && !empty($scheduleIds)) {
            $query->whereIn('schedule_id', $scheduleIds);
        }
        
        if ($muridId) {
            $query->where('murid_id', $muridId);
        } elseif ($user->isMurid() && $murid) {
            $query->where('murid_id', $murid->id);
        }
        
        // Filter by month
        $query->whereYear('date', $month->year)
            ->whereMonth('date', $month->month);
            
        $attendances = $query->with(['murid', 'schedule'])->get();
        
        // Prepare summary data
        $summary = [];
        
        foreach ($attendances as $attendance) {
            $muridId = $attendance->murid_id;
            $scheduleId = $attendance->schedule_id;
            $status = $attendance->status;
            
            if (!isset($summary[$muridId])) {
                $summary[$muridId] = [
                    'murid' => $attendance->murid,
                    'schedules' => [],
                    'total' => [
                        'present' => 0,
                        'absent' => 0,
                        'late' => 0,
                        'sick' => 0,
                        'permission' => 0
                    ]
                ];
            }
            
            if (!isset($summary[$muridId]['schedules'][$scheduleId])) {
                $summary[$muridId]['schedules'][$scheduleId] = [
                    'schedule' => $attendance->schedule,
                    'present' => 0,
                    'absent' => 0,
                    'late' => 0,
                    'sick' => 0,
                    'permission' => 0
                ];
            }
            
            $summary[$muridId]['schedules'][$scheduleId][$status]++;
            $summary[$muridId]['total'][$status]++;
        }
        
        return view('attendances.report', compact('summary', 'schedules', 'murids', 'month', 'scheduleId', 'muridId'));
    }
}