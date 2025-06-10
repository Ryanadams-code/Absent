@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Ruangan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="room_select" class="form-label">Pilih Ruangan</label>
                                    <select class="form-select @error('room_select') is-invalid @enderror" id="room_select" name="room_select">
                                        <option value="new" selected>-- Tambah Baru --</option>
                                        @foreach($rooms as $rm)
                                        <option value="{{ $rm->id }}" data-name="{{ $rm->name }}" data-code="{{ $rm->code }}" data-capacity="{{ $rm->capacity }}" data-building="{{ $rm->building }}" data-floor="{{ $rm->floor }}" data-description="{{ $rm->description }}">{{ $rm->name }} ({{ $rm->code }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="new_room_fields">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Ruangan</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Ruangan</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" required>
                                    @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Kapasitas</label>
                                    <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}">
                                    @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="building" class="form-label">Gedung</label>
                                    <input type="text" class="form-control @error('building') is-invalid @enderror" id="building" name="building" value="{{ old('building') }}">
                                    @error('building')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="floor" class="form-label">Lantai</label>
                                    <input type="text" class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor') }}">
                                    @error('floor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roomSelect = document.getElementById('room_select');
        const nameInput = document.getElementById('name');
        const codeInput = document.getElementById('code');
        const capacityInput = document.getElementById('capacity');
        const buildingInput = document.getElementById('building');
        const floorInput = document.getElementById('floor');
        const descriptionTextarea = document.getElementById('description');
        const newRoomFields = document.getElementById('new_room_fields');
        
        roomSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (this.value === 'new') {
                // Show fields for new room
                newRoomFields.style.display = 'flex';
                nameInput.value = '';
                codeInput.value = '';
                capacityInput.value = '';
                buildingInput.value = '';
                floorInput.value = '';
                descriptionTextarea.value = '';
                nameInput.required = true;
                codeInput.required = true;
            } else {
                // Fill fields with selected room data
                newRoomFields.style.display = 'none';
                nameInput.value = selectedOption.dataset.name;
                codeInput.value = selectedOption.dataset.code;
                capacityInput.value = selectedOption.dataset.capacity || '';
                buildingInput.value = selectedOption.dataset.building || '';
                floorInput.value = selectedOption.dataset.floor || '';
                descriptionTextarea.value = selectedOption.dataset.description || '';
                nameInput.required = false;
                codeInput.required = false;
            }
        });
        
        // Initial state setup
        if (roomSelect.value !== 'new') {
            const selectedOption = roomSelect.options[roomSelect.selectedIndex];
            newRoomFields.style.display = 'none';
            nameInput.value = selectedOption.dataset.name;
            codeInput.value = selectedOption.dataset.code;
            capacityInput.value = selectedOption.dataset.capacity || '';
            buildingInput.value = selectedOption.dataset.building || '';
            floorInput.value = selectedOption.dataset.floor || '';
            descriptionTextarea.value = selectedOption.dataset.description || '';
            nameInput.required = false;
            codeInput.required = false;
        }
    });
</script>
@endpush