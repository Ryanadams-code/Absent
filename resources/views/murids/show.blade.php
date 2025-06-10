@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detail Murid</h4>
                    <div>
                        <a href="{{ route('murids.edit', $murid->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('murids.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">NIS</th>
                                    <td>: {{ $murid->nis }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>: {{ $murid->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>: {{ $murid->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>: {{ date('d-m-Y', strtotime($murid->tanggal_lahir)) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Alamat</th>
                                    <td>: {{ $murid->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <td>: {{ $murid->no_telepon }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td>: {{ $murid->kelas }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: {{ $murid->user ? $murid->user->email : '-' }}</td>
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
