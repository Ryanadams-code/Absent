@extends('layouts.app')

@section('content')
<!-- Welcome Card with Material Design 3 styling -->
<div class="bg-surface-50 rounded-xl shadow-elevation-1 p-6 mb-6">
    <div class="flex items-center mb-4">
        <span class="material-icons-round p-2 bg-primary-100 text-primary-600 rounded-full mr-3">waving_hand</span>
        <h2 class="text-2xl font-medium text-gray-900">Selamat Datang di KelasKu, {{ Auth::user()->name }}!</h2>
    </div>
    <p class="text-gray-600 ml-12">Anda login sebagai <span class="font-medium text-primary-700">{{ Auth::user()->role }}</span></p>
</div>

<!-- Quick Stats Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-surface-50 rounded-xl shadow-elevation-1 p-4">
        <div class="flex items-center">
            <div class="p-2 bg-primary-100 rounded-full">
                <span class="material-icons-round text-primary-600">calendar_today</span>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-500">Hari Ini</p>
                <p class="text-lg font-medium text-gray-900">{{ date('d M Y') }}</p>
            </div>
        </div>
    </div>
    <div class="bg-surface-50 rounded-xl shadow-elevation-1 p-4">
        <div class="flex items-center">
            <div class="p-2 bg-primary-100 rounded-full">
                <span class="material-icons-round text-primary-600">schedule</span>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-500">Waktu</p>
                <p class="text-lg font-medium text-gray-900" id="current-time">{{ date('H:i') }}</p>
            </div>
        </div>
    </div>
    <div class="bg-surface-50 rounded-xl shadow-elevation-1 p-4">
        <div class="flex items-center">
            <div class="p-2 bg-primary-100 rounded-full">
                <span class="material-icons-round text-primary-600">person</span>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-500">Status</p>
                <p class="text-lg font-medium text-gray-900">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Menu Cards with Material Design 3 styling -->
<h3 class="text-lg font-medium text-gray-900 mb-4">Menu Utama</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <!-- Kelas Card -->
    <div class="bg-surface-50 rounded-xl shadow-elevation-1 hover:shadow-elevation-2 transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <span class="material-icons-round p-3 bg-primary-100 text-primary-600 rounded-full mr-3">school</span>
                <h3 class="text-xl font-medium text-gray-900">Data Kelas</h3>
            </div>
            <p class="text-gray-600 mb-6">Kelola data kelas, tambah, edit, dan hapus data kelas.</p>
            <a href="{{ route('kelas.index') }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800 transition-colors">
                <span>Kelola Data</span>
                <span class="material-icons-round ml-1 text-sm">arrow_forward</span>
            </a>
        </div>
    </div>

    <!-- Mata Pelajaran Card -->
    @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
    <div class="bg-surface-50 rounded-xl shadow-elevation-1 hover:shadow-elevation-2 transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <span class="material-icons-round p-3 bg-primary-100 text-primary-600 rounded-full mr-3">people</span>
                <h3 class="text-xl font-medium text-gray-900">Data Murid</h3>
            </div>
            <p class="text-gray-600 mb-6">Kelola data murid, tambah, edit, dan hapus data murid.</p>
            <a href="{{ route('murids.index') }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800 transition-colors">
                <span>Kelola Data</span>
                <span class="material-icons-round ml-1 text-sm">arrow_forward</span>
            </a>
        </div>
    </div>

    <div class="bg-surface-50 rounded-xl shadow-elevation-1 hover:shadow-elevation-2 transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <span class="material-icons-round p-3 bg-primary-100 text-primary-600 rounded-full mr-3">person</span>
                <h3 class="text-xl font-medium text-gray-900">Data Guru</h3>
            </div>
            <p class="text-gray-600 mb-6">Kelola data guru, tambah, edit, dan hapus data guru.</p>
            <a href="{{ route('gurus.index') }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800 transition-colors">
                <span>Kelola Data</span>
                <span class="material-icons-round ml-1 text-sm">arrow_forward</span>
            </a>
        </div>
    </div>

    <div class="bg-surface-50 rounded-xl shadow-elevation-1 hover:shadow-elevation-2 transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <span class="material-icons-round p-3 bg-primary-100 text-primary-600 rounded-full mr-3">book</span>
                <h3 class="text-xl font-medium text-gray-900">Mata Pelajaran</h3>
            </div>
            <p class="text-gray-600 mb-6">Kelola mata pelajaran, tambah, edit, dan hapus mata pelajaran.</p>
            <a href="{{ route('subjects.index') }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800 transition-colors">
                <span>Kelola Data</span>
                <span class="material-icons-round ml-1 text-sm">arrow_forward</span>
            </a>
        </div>
    </div>

    <div class="bg-surface-50 rounded-xl shadow-elevation-1 hover:shadow-elevation-2 transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <span class="material-icons-round p-3 bg-primary-100 text-primary-600 rounded-full mr-3">meeting_room</span>
                <h3 class="text-xl font-medium text-gray-900">Ruangan</h3>
            </div>
            <p class="text-gray-600 mb-6">Kelola data ruangan, tambah, edit, dan hapus data ruangan.</p>
            <a href="{{ route('rooms.index') }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800 transition-colors">
                <span>Kelola Data</span>
                <span class="material-icons-round ml-1 text-sm">arrow_forward</span>
            </a>
        </div>
    </div>
    @endif

    <div class="bg-surface-50 rounded-xl shadow-elevation-1 hover:shadow-elevation-2 transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <span class="material-icons-round p-3 bg-primary-100 text-primary-600 rounded-full mr-3">schedule</span>
                <h3 class="text-xl font-medium text-gray-900">Jadwal</h3>
            </div>
            <p class="text-gray-600 mb-6">Lihat jadwal pelajaran dan kelola jadwal.</p>
            <a href="{{ route('schedules.index') }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800 transition-colors">
                <span>Lihat Jadwal</span>
                <span class="material-icons-round ml-1 text-sm">arrow_forward</span>
            </a>
        </div>
    </div>

    <div class="bg-surface-50 rounded-xl shadow-elevation-1 hover:shadow-elevation-2 transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <span class="material-icons-round p-3 bg-primary-100 text-primary-600 rounded-full mr-3">fact_check</span>
                <h3 class="text-xl font-medium text-gray-900">Absensi</h3>
            </div>
            <p class="text-gray-600 mb-6">Kelola absensi, rekam kehadiran, dan lihat status absensi.</p>
            <a href="{{ route('attendances.index') }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800 transition-colors">
                <span>Kelola Absensi</span>
                <span class="material-icons-round ml-1 text-sm">arrow_forward</span>
            </a>
        </div>
    </div>

    <div class="bg-surface-50 rounded-xl shadow-elevation-1 hover:shadow-elevation-2 transition-shadow duration-300">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <span class="material-icons-round p-3 bg-primary-100 text-primary-600 rounded-full mr-3">assessment</span>
                <h3 class="text-xl font-medium text-gray-900">Laporan</h3>
            </div>
            <p class="text-gray-600 mb-6">Lihat dan unduh laporan absensi dalam berbagai format.</p>
            <a href="{{ route('attendances.report') }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800 transition-colors">
                <span>Lihat Laporan</span>
                <span class="material-icons-round ml-1 text-sm">arrow_forward</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Update current time every second
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            timeElement.textContent = `${hours}:${minutes}`;
        }
    }
    
    setInterval(updateTime, 1000);
    updateTime();
</script>
@endpush
@endsection
