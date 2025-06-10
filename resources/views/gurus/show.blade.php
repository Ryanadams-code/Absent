@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detail Guru</h4>
                    <div>
                        <a href="{{ route('gurus.edit', $guru->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('gurus.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">NIP</th>
                                    <td>: {{ $guru->nip }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>: {{ $guru->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>: {{ $guru->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>: {{ date('d-m-Y', strtotime($guru->tanggal_lahir)) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Alamat</th>
                                    <td>: {{ $guru->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <td>: {{ $guru->no_telepon }}</td>
                                </tr>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <td>: {{ $guru->mata_pelajaran }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: {{ $guru->user ? $guru->user->email : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection