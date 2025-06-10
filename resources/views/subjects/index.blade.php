@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Mata Pelajaran</h4>
                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                    <a href="{{ route('subjects.create') }}" class="btn btn-primary">Tambah Mata Pelajaran</a>
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
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $subject->code }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ Str::limit($subject->description, 50) ?: '-' }}</td>
                                    <td>
                                        <span class="badge {{ $subject->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $subject->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data mata pelajaran</td>
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