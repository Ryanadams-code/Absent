@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Kelas</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kelas.update', $kela->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kelas_select" class="form-label">Pilih Kelas</label>
                                    <select class="form-select @error('kelas_select') is-invalid @enderror" id="kelas_select" name="kelas_select">
                                        <option value="{{ $kela->id }}" selected>{{ $kela->name }} ({{ $kela->code }})</option>
                                        <option value="new">-- Tambah Baru --</option>
                                        @foreach($kelas as $kls)
                                            @if($kls->id != $kela->id)
                                            <option value="{{ $kls->id }}" data-name="{{ $kls->name }}" data-code="{{ $kls->code }}" data-capacity="{{ $kls->capacity }}" data-grade-level="{{ $kls->grade_level }}" data-major="{{ $kls->major }}" data-description="{{ $kls->description }}">{{ $kls->name }} ({{ $kls->code }})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="kelas_fields">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Kelas</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $kela->name) }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Kelas</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $kela->code) }}" required>
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
                                    <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity', $kela->capacity) }}">
                                    @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="grade_level" class="form-label">Tingkat Kelas</label>
                                    <select class="form-select @error('grade_level') is-invalid @enderror" id="grade_level" name="grade_level" required>
                                        <option value="" disabled>Pilih Tingkat</option>
                                        <option value="X" {{ old('grade_level', $kela->grade_level) == 'X' ? 'selected' : '' }}>X (Sepuluh)</option>
                                        <option value="XI" {{ old('grade_level', $kela->grade_level) == 'XI' ? 'selected' : '' }}>XI (Sebelas)</option>
                                        <option value="XII" {{ old('grade_level', $kela->grade_level) == 'XII' ? 'selected' : '' }}>XII (Dua Belas)</option>
                                    </select>
                                    @error('grade_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="major" class="form-label">Jurusan</label>
                                    <select class="form-select @error('major') is-invalid @enderror" id="major" name="major">
                                        <option value="" {{ old('major', $kela->major) ? '' : 'selected' }}>-- Tidak Ada --</option>
                                        <option value="IPA" {{ old('major', $kela->major) == 'IPA' ? 'selected' : '' }}>IPA</option>
                                        <option value="IPS" {{ old('major', $kela->major) == 'IPS' ? 'selected' : '' }}>IPS</option>
                                        <option value="Bahasa" {{ old('major', $kela->major) == 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                                    </select>
                                    @error('major')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $kela->description) }}</textarea>
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
                                        <option value="active" {{ old('status', $kela->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="inactive" {{ old('status', $kela->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
        const kelasSelect = document.getElementById('kelas_select');
        const nameInput = document.getElementById('name');
        const codeInput = document.getElementById('code');
        const capacityInput = document.getElementById('capacity');
        const gradeLevelSelect = document.getElementById('grade_level');
        const majorSelect = document.getElementById('major');
        const descriptionTextarea = document.getElementById('description');
        const kelasFields = document.getElementById('kelas_fields');
        
        // Store original values
        const originalName = nameInput.value;
        const originalCode = codeInput.value;
        const originalCapacity = capacityInput.value;
        const originalGradeLevel = gradeLevelSelect.value;
        const originalMajor = majorSelect.value;
        const originalDescription = descriptionTextarea.value;
        
        kelasSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (this.value === 'new') {
                // Show fields for new kelas
                kelasFields.style.display = 'flex';
                nameInput.value = '';
                codeInput.value = '';
                capacityInput.value = '';
                gradeLevelSelect.value = '';
                majorSelect.value = '';
                descriptionTextarea.value = '';
                nameInput.required = true;
                codeInput.required = true;
            } else if (this.value === '{{ $kela->id }}') {
                // Restore original values
                kelasFields.style.display = 'flex';
                nameInput.value = originalName;
                codeInput.value = originalCode;
                capacityInput.value = originalCapacity;
                gradeLevelSelect.value = originalGradeLevel;
                majorSelect.value = originalMajor;
                descriptionTextarea.value = originalDescription;
                nameInput.required = true;
                codeInput.required = true;
            } else {
                // Fill fields with selected kelas data
                kelasFields.style.display = 'none';
                nameInput.value = selectedOption.dataset.name;
                codeInput.value = selectedOption.dataset.code;
                capacityInput.value = selectedOption.dataset.capacity || '';
                gradeLevelSelect.value = selectedOption.dataset.gradeLevel || '';
                majorSelect.value = selectedOption.dataset.major || '';
                descriptionTextarea.value = selectedOption.dataset.description || '';
                nameInput.required = false;
                codeInput.required = false;
            }
        });
    });
</script>
@endpush