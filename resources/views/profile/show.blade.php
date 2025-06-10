@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Profil Pengguna</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="mb-4 text-center">
                        <div class="d-inline-block p-3 bg-primary-100 text-primary-600 rounded-full mb-3">
                            <span class="material-icons-round" style="font-size: 64px;">account_circle</span>
                        </div>
                        <h5 class="font-weight-bold">{{ $user->name }}</h5>
                        <p class="text-muted">{{ ucfirst($user->role) }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Informasi Akun</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-4 text-muted">Nama</div>
                                        <div class="col-md-8">{{ $user->name }}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4 text-muted">Email</div>
                                        <div class="col-md-8">{{ $user->email }}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4 text-muted">Role</div>
                                        <div class="col-md-8">{{ ucfirst($user->role) }}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4 text-muted">Bergabung Pada</div>
                                        <div class="col-md-8">{{ $user->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profil
                        </a>
                        <a href="{{ route('profile.password') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-key me-1"></i> Ubah Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection