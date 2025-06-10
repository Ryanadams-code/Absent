@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kelola Siswa untuk Jadwal: {{ $schedule->title }}</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h5 class="card-title">Informasi Jadwal</h5>
                                            <p class="card-text"><strong>Hari:</strong> {{ $schedule->day }}</p>
                                            <p class="card-text"><strong>Waktu:</strong>
                                                {{ substr($schedule->start_time, 0, 5) }} -
                                                {{ substr($schedule->end_time, 0, 5) }}</p>
                                            <p class="card-text"><strong>Guru:</strong> {{ $schedule->guru->nama }}</p>
                                            <p class="card-text"><strong>Mata Pelajaran:</strong> {{ $schedule->subject }}
                                            </p>
                                            <p class="card-text"><strong>Ruangan:</strong> {{ $schedule->room ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('schedules.update-students', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Pilih Siswa</label>
                                        <div class="alert alert-info">
                                            <i class="bi bi-info-circle"></i> Pilih siswa yang akan ditambahkan ke jadwal
                                            ini. Siswa dapat memiliki maksimal 4 jadwal per hari.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="select-all">
                                                </div>
                                            </th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Jadwal Hari {{ $schedule->day }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($murids as $murid)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input murid-checkbox" type="checkbox"
                                                            name="murid_ids[]" value="{{ $murid->id }}"
                                                            {{ in_array($murid->id, $assignedMuridIds) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td>{{ $murid->nis }}</td>
                                                <td>{{ $murid->nama }}</td>
                                                <td>{{ $murid->kelas }}</td>
                                                <td>
                                                    @php
                                                        $scheduleCount = $murid->schedules
                                                            ? $murid->schedules->where('day', $schedule->day)->count()
                                                            : 0;
                                                        $isCurrentSchedule = $murid->schedules
                                                            ? $murid->schedules->contains($schedule->id)
                                                            : false;
                                                        $maxSchedules = 4;
                                                    @endphp

                                                    @if ($isCurrentSchedule)
                                                        <span class="badge bg-primary">Terdaftar di jadwal ini</span>
                                                    @endif

                                                    <span
                                                        class="badge {{ $scheduleCount >= $maxSchedules && !$isCurrentSchedule ? 'bg-danger' : 'bg-info' }}">
                                                        {{ $scheduleCount }} / {{ $maxSchedules }} jadwal
                                                    </span>

                                                    @if ($scheduleCount >= $maxSchedules && !$isCurrentSchedule)
                                                        <span class="text-danger">Siswa sudah mencapai batas maksimal jadwal
                                                            untuk hari {{ $schedule->day }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('schedules.index', $schedule->id) }}"
                                    class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Select all checkbox functionality
            document.getElementById('select-all').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.murid-checkbox');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        </script>
    @endpush
@endsection
