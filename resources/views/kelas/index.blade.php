@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Kelas</h4>
                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                    <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Kelas</a>
                    @endif
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Tingkat</th>
                                    <th>Jurusan</th>
                                    <th>Kapasitas</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kelas as $kls)
                                <tr>
                                    <td>{{ $kls->code }}</td>
                                    <td>{{ $kls->name }}</td>
                                    <td>{{ $kls->grade_level }}</td>
                                    <td>{{ $kls->major ?: '-' }}</td>
                                    <td>{{ $kls->capacity ?: '-' }}</td>
                                    <td>
                                        <span class="badge {{ $kls->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $kls->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('kelas.show', $kls->id) }}" class="btn btn-sm btn-info">Detail</a>
                                            @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                                            <a href="{{ route('kelas.edit', $kls->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('kelas.destroy', $kls->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data kelas</td>
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