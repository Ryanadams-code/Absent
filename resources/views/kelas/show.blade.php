@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detail Kelas</h4>
                    <div>
                        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                        <a href="{{ route('kelas.edit', $kela->id) }}" class="btn btn-warning">Edit</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Kode</th>
                                    <td>{{ $kela->code }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $kela->name }}</td>
                                </tr>
                                <tr>
                                    <th>Tingkat</th>
                                    <td>{{ $kela->grade_level }}</td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td>{{ $kela->major ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kapasitas</th>
                                    <td>{{ $kela->capacity ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $kela->description ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $kela->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $kela->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat Pada</th>
                                    <td>{{ $kela->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diperbarui Pada</th>
                                    <td>{{ $kela->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Daftar Siswa</h5>
                                </div>
                                <div class="card-body">
                                    @if($kela->murids->count() > 0)
                                    <ul class="list-group">
                                        @foreach($kela->murids as $murid)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $murid->nama }}</strong><br>
                                                <small>{{ $murid->nis }}</small>
                                            </div>
                                            <a href="{{ route('murids.show', $murid->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p class="text-muted">Tidak ada siswa yang terdaftar di kelas ini.</p>
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