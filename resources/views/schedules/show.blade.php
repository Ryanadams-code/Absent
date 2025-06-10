@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detail Jadwal</h4>
                    <div>
                        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning">Edit</a>
                        @endif
                        @if(Auth::user()->isGuru())
                        <a href="{{ route('attendances.create', ['schedule_id' => $schedule->id]) }}" class="btn btn-success">Isi Absensi</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Judul Jadwal</th>
                                    <td>{{ $schedule->title }}</td>
                                </tr>
                                <tr>
                                    <th>Hari</th>
                                    <td>{{ $schedule->day }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu</th>
                                    <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                                </tr>
                                <tr>
                                    <th>Guru</th>
                                    <td>{{ $schedule->guru->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <td>{{ $schedule->subject }}</td>
                                </tr>
                                <tr>
                                    <th>Ruangan</th>
                                    <td>{{ $schedule->room ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $schedule->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $schedule->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $schedule->description ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>Daftar Siswa</h5>
                                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                                    <a href="{{ route('schedules.manage-students', $schedule->id) }}" class="btn btn-sm btn-primary">Kelola Siswa</a>
                                    @endif
                                </div>
                                <div class="card-body">
                                    @if($schedule->murids->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIS</th>
                                                    <th>Nama</th>
                                                    <th>Kelas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($schedule->murids as $index => $murid)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $murid->nis }}</td>
                                                    <td>{{ $murid->nama }}</td>
                                                    <td>{{ $murid->kelas }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="alert alert-info">
                                        Belum ada siswa yang ditambahkan ke jadwal ini.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection