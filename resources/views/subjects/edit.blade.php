@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Mata Pelajaran</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subject_select" class="form-label">Pilih Mata Pelajaran</label>
                                    <select class="form-select @error('subject_select') is-invalid @enderror" id="subject_select" name="subject_select">
                                        <option value="{{ $subject->id }}" selected>{{ $subject->name }} ({{ $subject->code }}) - Saat Ini</option>
                                        <option value="new">-- Tambah Baru --</option>
                                        @foreach($subjects as $subj)
                                            @if($subj->id != $subject->id)
                                            <option value="{{ $subj->id }}" data-name="{{ $subj->name }}" data-code="{{ $subj->code }}" data-description="{{ $subj->description }}">{{ $subj->name }} ({{ $subj->code }})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="subject_fields">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Mata Pelajaran</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $subject->name) }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Mata Pelajaran</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $subject->code) }}" required>
                                    @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $subject->description) }}</textarea>
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
                                        <option value="active" {{ old('status', $subject->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="inactive" {{ old('status', $subject->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Kembali</a>
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
        const subjectSelect = document.getElementById('subject_select');
        const nameInput = document.getElementById('name');
        const codeInput = document.getElementById('code');
        const descriptionTextarea = document.getElementById('description');
        const subjectFields = document.getElementById('subject_fields');
        
        // Store original values
        const originalName = nameInput.value;
        const originalCode = codeInput.value;
        const originalDescription = descriptionTextarea.value;
        
        subjectSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (this.value === 'new') {
                // Show fields for new subject
                subjectFields.style.display = 'flex';
                nameInput.value = '';
                codeInput.value = '';
                descriptionTextarea.value = '';
                nameInput.required = true;
                codeInput.required = true;
            } else if (this.value === '{{ $subject->id }}') {
                // Restore original values
                subjectFields.style.display = 'flex';
                nameInput.value = originalName;
                codeInput.value = originalCode;
                descriptionTextarea.value = originalDescription;
                nameInput.required = true;
                codeInput.required = true;
            } else {
                // Fill fields with selected subject data
                subjectFields.style.display = 'none';
                nameInput.value = selectedOption.dataset.name;
                codeInput.value = selectedOption.dataset.code;
                descriptionTextarea.value = selectedOption.dataset.description || '';
                nameInput.required = false;
                codeInput.required = false;
            }
        });
    });
</script>
@endpush