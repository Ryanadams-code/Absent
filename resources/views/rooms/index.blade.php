@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Ruangan</h4>
                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Tambah Ruangan</a>
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
                                    <th>Kapasitas</th>
                                    <th>Gedung</th>
                                    <th>Lantai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rooms as $index => $room)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $room->code }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->capacity ?: '-' }}</td>
                                    <td>{{ $room->building ?: '-' }}</td>
                                    <td>{{ $room->floor ?: '-' }}</td>
                                    <td>
                                        <span class="badge {{ $room->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $room->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data ruangan</td>
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