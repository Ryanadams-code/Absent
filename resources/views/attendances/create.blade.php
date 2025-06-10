@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Isi Absensi</h4>
                    <div>
                        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Informasi Jadwal</h5>
                                    <p class="card-text"><strong>Judul:</strong> {{ $schedule->title }}</p>
                                    <p class="card-text"><strong>Hari:</strong> {{ $schedule->day }}</p>
                                    <p class="card-text"><strong>Waktu:</strong> {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</p>
                                    <p class="card-text"><strong>Mata Pelajaran:</strong> {{ $schedule->subject }}</p>
                                    <p class="card-text"><strong>Ruangan:</strong> {{ $schedule->room ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Tanggal Absensi</h5>
                                    <form id="date-form" action="{{ route('attendances.create') }}" method="GET">
                                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Pilih Tanggal</label>
                                            <input type="date" class="form-control" id="date" name="date" value="{{ $date }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($schedule->murids->count() > 0)
                    <form action="{{ route('attendances.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        <input type="hidden" name="date" value="{{ $date }}">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Status Kehadiran</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedule->murids as $index => $murid)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $murid->nis }}</td>
                                        <td>{{ $murid->nama }}</td>
                                        <td>{{ $murid->kelas }}</td>
                                        <td>
                                            <input type="hidden" name="murid_ids[]" value="{{ $murid->id }}">
                                            @php
                                                $attendance = $attendances->where('murid_id', $murid->id)->first();
                                                $status = $attendance ? $attendance->status : 'absent';
                                            @endphp
                                            <div class="d-flex flex-wrap gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status[{{ $murid->id }}]" id="present-{{ $murid->id }}" value="present" {{ $status == 'present' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="present-{{ $murid->id }}">
                                                        Hadir
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status[{{ $murid->id }}]" id="absent-{{ $murid->id }}" value="absent" {{ $status == 'absent' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="absent-{{ $murid->id }}">
                                                        Tidak Hadir
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status[{{ $murid->id }}]" id="late-{{ $murid->id }}" value="late" {{ $status == 'late' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="late-{{ $murid->id }}">
                                                        Terlambat
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status[{{ $murid->id }}]" id="sick-{{ $murid->id }}" value="sick" {{ $status == 'sick' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="sick-{{ $murid->id }}">
                                                        Sakit
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status[{{ $murid->id }}]" id="permission-{{ $murid->id }}" value="permission" {{ $status == 'permission' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission-{{ $murid->id }}">
                                                        Izin
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="notes[{{ $murid->id }}]" value="{{ $attendance ? $attendance->notes : '' }}" placeholder="Catatan (opsional)">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-success">Simpan Absensi</button>
                        </div>
                    </form>
                    @else
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i> Belum ada siswa yang ditambahkan ke jadwal ini. Silakan tambahkan siswa terlebih dahulu.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection