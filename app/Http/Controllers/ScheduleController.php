<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Guru;
use App\Models\Murid;
use App\Models\Subject;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin() || $user->isTataUsaha()) {
            // Admin dan tata usaha dapat melihat semua jadwal
            $schedules = Schedule::with('guru')->get();
        } elseif ($user->isGuru()) {
            // Guru hanya melihat jadwal mereka sendiri
            $guru = Guru::where('user_id', $user->id)->first();
            if (!$guru) {
                return redirect()->route('dashboard')
                    ->with('error', 'Profil guru tidak ditemukan');
            }
            $schedules = Schedule::where('guru_id', $guru->id)->get();
        } else {
            // Murid hanya melihat jadwal yang mereka ikuti
            $murid = Murid::where('user_id', $user->id)->first();
            if (!$murid) {
                return redirect()->route('dashboard')
                    ->with('error', 'Profil murid tidak ditemukan');
            }
            $schedules = $murid->schedules;
        }

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::where('record_flag', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        $rooms = Room::where('status', 'active')->get();
        return view('schedules.create', compact('gurus', 'subjects', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'guru_id' => 'required|exists:gurus,id',
            'subject_id' => 'required|exists:subjects,id',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Get subject and room data for backward compatibility
        $subject = Subject::findOrFail($request->subject_id);
        $room = Room::findOrFail($request->room_id);

        $data = $request->all();
        $data['subject'] = $subject->name; // Keep the old field for backward compatibility
        $data['room'] = $room->name; // Keep the old field for backward compatibility

        Schedule::create($data);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $schedule->load('guru', 'murids');
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $gurus = Guru::where('record_flag', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        $rooms = Room::where('status', 'active')->get();
        return view('schedules.edit', compact('schedule', 'gurus', 'subjects', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'guru_id' => 'required|exists:gurus,id',
            'subject_id' => 'required|exists:subjects,id',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Get subject and room data for backward compatibility
        $subject = Subject::findOrFail($request->subject_id);
        $room = Room::findOrFail($request->room_id);

        $data = $request->all();
        $data['subject'] = $subject->name; // Keep the old field for backward compatibility
        $data['room'] = $room->name; // Keep the old field for backward compatibility

        $schedule->update($data);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }

    /**
     * Manage students assigned to a schedule.
     */
    public function manageStudents(Schedule $schedule)
    {
        $schedule->load('murids');

        // Eager load 'schedules' for each murid
        $murids = Murid::where('record_flag', 'active')->with('schedules')->get();

        $assignedMuridIds = $schedule->murids->pluck('id')->toArray();

        return view('schedules.manage-students', compact('schedule', 'murids', 'assignedMuridIds'));
    }


    /**
     * Update students assigned to a schedule.
     */
    public function updateStudents(Request $request, Schedule $schedule)
    {
        $request->validate([
            'murid_ids' => 'required|array',
            'murid_ids.*' => 'exists:murids,id',
        ]);

        $schedule->murids()->sync($request->murid_ids);

        return redirect()->route('schedules.show', $schedule->id)
            ->with('success', 'Daftar siswa berhasil diperbarui');
    }
}
