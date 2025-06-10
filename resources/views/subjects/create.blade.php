@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Mata Pelajaran Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('subjects.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3" id="new_subject_fields">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Mata Pelajaran</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Mata Pelajaran</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" required>
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
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Kembali</a>
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
        const subjectSelect = document.getElementById('subject_select');
        const nameInput = document.getElementById('name');
        const codeInput = document.getElementById('code');
        const descriptionTextarea = document.getElementById('description');
        const newSubjectFields = document.getElementById('new_subject_fields');

        subjectSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            if (this.value === 'new') {
                // Show fields for new subject
                newSubjectFields.style.display = 'flex';
                nameInput.value = '';
                codeInput.value = '';
                descriptionTextarea.value = '';
                nameInput.required = true;
                codeInput.required = true;
            } else {
                // Fill fields with selected subject data
                newSubjectFields.style.display = 'none';
                nameInput.value = selectedOption.dataset.name;
                codeInput.value = selectedOption.dataset.code;
                descriptionTextarea.value = selectedOption.dataset.description || '';
                nameInput.required = false;
                codeInput.required = false;
            }
        });

        // Initial state setup
        if (subjectSelect.value !== 'new') {
            const selectedOption = subjectSelect.options[subjectSelect.selectedIndex];
            newSubjectFields.style.display = 'none';
            nameInput.value = selectedOption.dataset.name;
            codeInput.value = selectedOption.dataset.code;
            descriptionTextarea.value = selectedOption.dataset.description || '';
            nameInput.required = false;
            codeInput.required = false;
        }
    });
</script>
@endpush
