@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detail Ruangan</h4>
                    <div>
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Kembali</a>
                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Edit</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Kode</th>
                                    <td>{{ $room->code }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $room->name }}</td>
                                </tr>
                                <tr>
                                    <th>Kapasitas</th>
                                    <td>{{ $room->capacity ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Gedung</th>
                                    <td>{{ $room->building ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Lantai</th>
                                    <td>{{ $room->floor ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $room->description ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $room->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $room->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat Pada</th>
                                    <td>{{ $room->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diperbarui Pada</th>
                                    <td>{{ $room->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Jadwal Terkait</h5>
                                </div>
                                <div class="card-body">
                                    @if($room->schedules->count() > 0)
                                    <ul class="list-group">
                                        @foreach($room->schedules as $schedule)
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
                                    <p class="text-muted">Tidak ada jadwal yang menggunakan ruangan ini.</p>
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