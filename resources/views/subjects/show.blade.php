@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detail Mata Pelajaran</h4>
                    <div>
                        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Kembali</a>
                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning">Edit</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Kode</th>
                                    <td>{{ $subject->code }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $subject->name }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $subject->description ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $subject->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $subject->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat Pada</th>
                                    <td>{{ $subject->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diperbarui Pada</th>
                                    <td>{{ $subject->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Jadwal Terkait</h5>
                                </div>
                                <div class="card-body">
                                    @if($subject->schedules->count() > 0)
                                    <ul class="list-group">
                                        @foreach($subject->schedules as $schedule)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $schedule->title }}</strong><br>
                                                <small>{{ $schedule->day }}, {{ $schedule->start_time }} - {{ $schedule->end_time }}</small>
                                            </div>
                                            <a href="{{ route('schedules.show', $schedule->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p class="text-muted">Tidak ada jadwal yang menggunakan mata pelajaran ini.</p>
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