@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Absensi</h4>
                    <div>
                        <a href="{{ route('attendances.report') }}" class="btn btn-info">Laporan Absensi</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Filter Absensi</h5>
                                    <form action="{{ route('attendances.index') }}" method="GET" class="row g-3">
                                        <div class="col-md-3">
                                            <label for="schedule_id" class="form-label">Jadwal</label>
                                            <select class="form-select" id="schedule_id" name="schedule_id">
                                                <option value="">Semua Jadwal</option>
                                                @foreach($schedules as $schedule)
                                                <option value="{{ $schedule->id }}" {{ request('schedule_id') == $schedule->id ? 'selected' : '' }}>
                                                    {{ $schedule->title }} ({{ $schedule->day }}, {{ substr($schedule->start_time, 0, 5) }})
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="">Semua Status</option>
                                                <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Hadir</option>
                                                <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Tidak Hadir</option>
                                                <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Terlambat</option>
                                                <option value="sick" {{ request('status') == 'sick' ? 'selected' : '' }}>Sakit</option>
                                                <option value="permission" {{ request('status') == 'permission' ? 'selected' : '' }}>Izin</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <div class="d-grid gap-2 d-md-flex">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                                <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jadwal</th>
                                    <th>Siswa</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                    <th>Diisi Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $index => $attendance)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                                    <td>
                                        {{ $attendance->schedule->title }}<br>
                                        <small class="text-muted">{{ $attendance->schedule->day }}, {{ substr($attendance->schedule->start_time, 0, 5) }} - {{ substr($attendance->schedule->end_time, 0, 5) }}</small>
                                    </td>
                                    <td>
                                        {{ $attendance->murid->nama }}<br>
                                        <small class="text-muted">{{ $attendance->murid->nis }} ({{ $attendance->murid->kelas }})</small>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'present' => 'bg-success',
                                                'absent' => 'bg-danger',
                                                'late' => 'bg-warning',
                                                'sick' => 'bg-info',
                                                'permission' => 'bg-secondary'
                                            ];
                                            $statusText = [
                                                'present' => 'Hadir',
                                                'absent' => 'Tidak Hadir',
                                                'late' => 'Terlambat',
                                                'sick' => 'Sakit',
                                                'permission' => 'Izin'
                                            ];
                                        @endphp
                                        <span class="badge {{ $statusClass[$attendance->status] }}">
                                            {{ $statusText[$attendance->status] }}
                                        </span>
                                    </td>
                                    <td>{{ $attendance->notes ?? '-' }}</td>
                                    <td>{{ $attendance->markedBy->name }}</td>
                                    <td>
                                        @if(Auth::user()->isGuru() && Auth::user()->id == $attendance->marked_by)
                                        <a href="{{ route('attendances.create', ['schedule_id' => $attendance->schedule_id, 'date' => $attendance->date]) }}" class="btn btn-sm btn-warning">Edit</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data absensi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $attendances->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection