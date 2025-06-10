@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Jadwal</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Jadwal</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $schedule->title) }}" required>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="day" class="form-label">Hari</label>
                                    <select class="form-select @error('day') is-invalid @enderror" id="day" name="day" required>
                                        <option value="" disabled>Pilih Hari</option>
                                        <option value="Senin" {{ old('day', $schedule->day) == 'Senin' ? 'selected' : '' }}>Senin</option>
                                        <option value="Selasa" {{ old('day', $schedule->day) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                        <option value="Rabu" {{ old('day', $schedule->day) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                        <option value="Kamis" {{ old('day', $schedule->day) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                        <option value="Jumat" {{ old('day', $schedule->day) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                        <option value="Sabtu" {{ old('day', $schedule->day) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                        <option value="Minggu" {{ old('day', $schedule->day) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                    </select>
                                    @error('day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Waktu Mulai</label>
                                    <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required>
                                    @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_time" class="form-label">Waktu Selesai</label>
                                    <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" required>
                                    @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="guru_id" class="form-label">Guru</label>
                                    <select class="form-select @error('guru_id') is-invalid @enderror" id="guru_id" name="guru_id" required>
                                        <option value="" disabled>Pilih Guru</option>
                                        @foreach($gurus as $guru)
                                        <option value="{{ $guru->id }}" {{ old('guru_id', $schedule->guru_id) == $guru->id ? 'selected' : '' }}>{{ $guru->nama }} ({{ $guru->nip }})</option>
                                        @endforeach
                                    </select>
                                    @error('guru_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subject_id" class="form-label">Mata Pelajaran</label>
                                    <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                                        <option value="" disabled>Pilih Mata Pelajaran</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ old('subject_id', $schedule->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }} ({{ $subject->code }})</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="room_id" class="form-label">Ruangan</label>
                                    <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                                        <option value="" disabled>Pilih Ruangan</option>
                                        @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" {{ old('room_id', $schedule->room_id) == $room->id ? 'selected' : '' }}>{{ $room->name }} ({{ $room->code }})</option>
                                        @endforeach
                                    </select>
                                    @error('room_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="active" {{ old('status', $schedule->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="inactive" {{ old('status', $schedule->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $schedule->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection