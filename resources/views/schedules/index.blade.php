@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Jadwal Pelajaran</h4>
                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                    <a href="{{ route('schedules.create') }}" class="btn btn-primary">Tambah Jadwal</a>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Guru</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Ruangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($schedules as $index => $schedule)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $schedule->title }}</td>
                                    <td>{{ $schedule->day }}</td>
                                    <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                                    <td>{{ $schedule->guru->nama }}</td>
                                    <td>{{ $schedule->subject }}</td>
                                    <td>{{ $schedule->room ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $schedule->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $schedule->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('schedules.show', $schedule->id) }}" class="btn btn-sm btn-info">Detail</a>
                                            @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ route('schedules.manage-students', $schedule->id) }}" class="btn btn-sm btn-primary">Kelola Siswa</a>
                                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                            @endif
                                            @if(Auth::user()->isGuru())
                                            <a href="{{ route('attendances.create', ['schedule_id' => $schedule->id]) }}" class="btn btn-sm btn-success">Isi Absensi</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data jadwal</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection