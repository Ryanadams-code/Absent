@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Laporan Absensi</h4>
                    <div>
                        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Filter Laporan</h5>
                                    <form action="{{ route('attendances.report') }}" method="GET" class="row g-3">
                                        <div class="col-md-3">
                                            <label for="month" class="form-label">Bulan</label>
                                            <input type="month" class="form-control" id="month" name="month" value="{{ request('month', date('Y-m')) }}" required>
                                        </div>
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
                                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                                        <div class="col-md-3">
                                            <label for="murid_id" class="form-label">Siswa</label>
                                            <select class="form-select" id="murid_id" name="murid_id">
                                                <option value="">Semua Siswa</option>
                                                @foreach($murids as $murid)
                                                <option value="{{ $murid->id }}" {{ request('murid_id') == $murid->id ? 'selected' : '' }}>
                                                    {{ $murid->nama }} ({{ $murid->nis }})
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                        <div class="col-md-3 d-flex align-items-end">
                                            <div class="d-grid gap-2 d-md-flex">
                                                <button type="submit" class="btn btn-primary">Tampilkan</button>
                                                <button type="submit" class="btn btn-success" name="export" value="1">Export Excel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($reportData) && count($reportData) > 0)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Ringkasan Absensi - {{ \Carbon\Carbon::parse(request('month').'-01')->format('F Y') }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="card bg-success text-white mb-3">
                                                <div class="card-body text-center">
                                                    <h3>{{ $summary['present'] }}</h3>
                                                    <p class="mb-0">Hadir</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="card bg-danger text-white mb-3">
                                                <div class="card-body text-center">
                                                    <h3>{{ $summary['absent'] }}</h3>
                                                    <p class="mb-0">Tidak Hadir</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="card bg-warning text-dark mb-3">
                                                <div class="card-body text-center">
                                                    <h3>{{ $summary['late'] }}</h3>
                                                    <p class="mb-0">Terlambat</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="card bg-info text-white mb-3">
                                                <div class="card-body text-center">
                                                    <h3>{{ $summary['sick'] }}</h3>
                                                    <p class="mb-0">Sakit</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="card bg-secondary text-white mb-3">
                                                <div class="card-body text-center">
                                                    <h3>{{ $summary['permission'] }}</h3>
                                                    <p class="mb-0">Izin</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="card bg-primary text-white mb-3">
                                                <div class="card-body text-center">
                                                    <h3>{{ $summary['total'] }}</h3>
                                                    <p class="mb-0">Total</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th rowspan="2" class="align-middle">No</th>
                                    <th rowspan="2" class="align-middle">Nama Siswa</th>
                                    <th rowspan="2" class="align-middle">Kelas</th>
                                    <th rowspan="2" class="align-middle">Jadwal</th>
                                    <th colspan="5" class="text-center">Jumlah Kehadiran</th>
                                    <th rowspan="2" class="align-middle">Total</th>
                                </tr>
                                <tr>
                                    <th class="text-center bg-success text-white">Hadir</th>
                                    <th class="text-center bg-danger text-white">Tidak Hadir</th>
                                    <th class="text-center bg-warning text-dark">Terlambat</th>
                                    <th class="text-center bg-info text-white">Sakit</th>
                                    <th class="text-center bg-secondary text-white">Izin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reportData as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data['murid_nama'] }}</td>
                                    <td>{{ $data['kelas'] }}</td>
                                    <td>{{ $data['schedule_title'] }}</td>
                                    <td class="text-center">{{ $data['present'] }}</td>
                                    <td class="text-center">{{ $data['absent'] }}</td>
                                    <td class="text-center">{{ $data['late'] }}</td>
                                    <td class="text-center">{{ $data['sick'] }}</td>
                                    <td class="text-center">{{ $data['permission'] }}</td>
                                    <td class="text-center">{{ $data['total'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Tidak ada data absensi untuk filter yang dipilih. Silakan ubah filter atau pilih bulan lain.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection