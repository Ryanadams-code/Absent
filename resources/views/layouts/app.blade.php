<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KelasKu - Sistem Absensi Sekolah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
</head>
<body class="bg-surface-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Material Design 3 Navigation Rail -->
        <aside class="hidden md:flex flex-col w-64 bg-surface-50 shadow-elevation-2 z-10">
            <!-- Logo and App Title -->
            <div class="flex items-center justify-center h-16 px-4 border-b border-surface-200">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img src="/images/logo.png" alt="KelasKu Logo" class="h-20 w-30 mr-2">
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto py-4 px-3">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('dashboard') ? 'bg-primary-100 text-primary-700' : '' }}">
                            <span class="material-icons-round mr-3 {{ request()->routeIs('dashboard') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">dashboard</span>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>

                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                    <li>
                        <a href="{{ route('murids.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('murids.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                            <span class="material-icons-round mr-3 {{ request()->routeIs('murids.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">people</span>
                            <span class="font-medium">Data Murid</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gurus.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('gurus.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                            <span class="material-icons-round mr-3 {{ request()->routeIs('gurus.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">person</span>
                            <span class="font-medium">Data Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('subjects.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('subjects.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                            <span class="material-icons-round mr-3 {{ request()->routeIs('subjects.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">book</span>
                            <span class="font-medium">Mata Pelajaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rooms.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('rooms.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                            <span class="material-icons-round mr-3 {{ request()->routeIs('rooms.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">meeting_room</span>
                            <span class="font-medium">Ruangan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kelas.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('kelas.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                            <span class="material-icons-round mr-3 {{ request()->routeIs('kelas.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">school</span>
                            <span class="font-medium">Kelas</span>
                        </a>
                    </li>
                    @endif

                    <li>
                        <a href="{{ route('schedules.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('schedules.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                            <span class="material-icons-round mr-3 {{ request()->routeIs('schedules.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">schedule</span>
                            <span class="font-medium">Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attendances.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('attendances.index') ? 'bg-primary-100 text-primary-700' : '' }}">
                            <span class="material-icons-round mr-3 {{ request()->routeIs('attendances.index') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">fact_check</span>
                            <span class="font-medium">Absensi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attendances.report') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('attendances.report') ? 'bg-primary-100 text-primary-700' : '' }}">
                            <span class="material-icons-round mr-3 {{ request()->routeIs('attendances.report') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">assessment</span>
                            <span class="font-medium">Laporan</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Profile Section -->
            <div class="p-4 border-t border-surface-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="material-icons-round p-2 bg-primary-100 text-primary-600 rounded-full">account_circle</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                    </div>
                    <div class="ml-auto relative">
                        <button type="button" class="text-gray-500 hover:text-gray-700" id="user-menu-button">
                            <span class="material-icons-round">more_vert</span>
                        </button>
                        <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50" id="user-menu">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-surface-100">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-surface-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile Navigation Drawer - Material Design 3 -->
        <div class="fixed inset-0 z-40 hidden" id="mobile-menu">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
            <div class="relative flex flex-col w-full max-w-xs bg-surface-50 h-full overflow-y-auto">
                <div class="flex items-center justify-between h-16 px-4 border-b border-surface-200">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="/images/logo.svg" alt="KelasKu Logo" class="h-8 w-auto mr-2">
                        <span class="text-xl font-medium text-gray-900">KelasKu</span>
                    </a>
                    <button type="button" class="text-gray-500 hover:text-gray-700" id="close-mobile-menu">
                        <span class="material-icons-round">close</span>
                    </button>
                </div>
                <nav class="flex-1 px-2 py-4">
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('dashboard') ? 'bg-primary-100 text-primary-700' : '' }}">
                                <span class="material-icons-round mr-3 {{ request()->routeIs('dashboard') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">dashboard</span>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        </li>

                        @if(Auth::user()->isSuperAdmin() || Auth::user()->isTataUsaha())
                        <li>
                            <a href="{{ route('murids.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('murids.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                                <span class="material-icons-round mr-3 {{ request()->routeIs('murids.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">people</span>
                                <span class="font-medium">Data Murid</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gurus.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('gurus.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                                <span class="material-icons-round mr-3 {{ request()->routeIs('gurus.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">person</span>
                                <span class="font-medium">Data Guru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('subjects.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('subjects.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                                <span class="material-icons-round mr-3 {{ request()->routeIs('subjects.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">book</span>
                                <span class="font-medium">Mata Pelajaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rooms.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('rooms.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                                <span class="material-icons-round mr-3 {{ request()->routeIs('rooms.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">meeting_room</span>
                                <span class="font-medium">Ruangan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kelas.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('kelas.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                                <span class="material-icons-round mr-3 {{ request()->routeIs('kelas.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">school</span>
                                <span class="font-medium">Kelas</span>
                            </a>
                        </li>
                        @endif

                        <li>
                            <a href="{{ route('schedules.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('schedules.*') ? 'bg-primary-100 text-primary-700' : '' }}">
                                <span class="material-icons-round mr-3 {{ request()->routeIs('schedules.*') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">schedule</span>
                                <span class="font-medium">Jadwal</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('attendances.index') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('attendances.index') ? 'bg-primary-100 text-primary-700' : '' }}">
                                <span class="material-icons-round mr-3 {{ request()->routeIs('attendances.index') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">fact_check</span>
                                <span class="font-medium">Absensi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('attendances.report') }}" class="flex items-center px-4 py-3 text-gray-800 rounded-lg hover:bg-primary-50 group transition-colors {{ request()->routeIs('attendances.report') ? 'bg-primary-100 text-primary-700' : '' }}">
                                <span class="material-icons-round mr-3 {{ request()->routeIs('attendances.report') ? 'text-primary-600' : 'text-gray-500 group-hover:text-primary-600' }}">assessment</span>
                                <span class="font-medium">Laporan</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="p-4 border-t border-surface-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="material-icons-round p-2 bg-primary-100 text-primary-600 rounded-full">account_circle</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('profile.show') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-surface-100">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-surface-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top App Bar - Material Design 3 -->
            <header class="bg-surface-100 shadow-sm z-10">
                <div class="flex items-center justify-between h-16 px-4">
                    <!-- Mobile menu button -->
                    <button type="button" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none" id="mobile-menu-button">
                        <span class="material-icons-round">menu</span>
                    </button>

                    <!-- Page Title -->
                    <h1 class="text-xl font-medium text-gray-800 md:ml-0 ml-3">{{ $title ?? 'Dashboard' }}</h1>

                    <!-- Right side actions -->
                    <div class="flex items-center space-x-4">
                        <button type="button" class="p-2 rounded-full text-gray-500 hover:text-gray-700 hover:bg-surface-200 focus:outline-none">
                            <span class="material-icons-round">notifications</span>
                        </button>
                        <button type="button" class="p-2 rounded-full text-gray-500 hover:text-gray-700 hover:bg-surface-200 focus:outline-none md:hidden" id="mobile-profile-button">
                            <span class="material-icons-round">account_circle</span>
                        </button>
                        <!-- Mobile Profile Menu -->
                        <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 top-16" id="mobile-profile-menu">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-surface-100">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-surface-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-surface-100 p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // User menu toggle
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        if (userMenuButton && userMenu) {
            userMenuButton.addEventListener('click', () => {
                userMenu.classList.toggle('hidden');
            });

            // Close the menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                    userMenu.classList.add('hidden');
                }
            });
        }

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMobileMenuButton = document.getElementById('close-mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        if (closeMobileMenuButton && mobileMenu) {
            closeMobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        }

        // Mobile profile button toggle
        const mobileProfileButton = document.getElementById('mobile-profile-button');
        const mobileProfileMenu = document.getElementById('mobile-profile-menu');

        if (mobileProfileButton && mobileProfileMenu) {
            mobileProfileButton.addEventListener('click', () => {
                mobileProfileMenu.classList.toggle('hidden');
            });

            // Close the menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!mobileProfileButton.contains(event.target) && !mobileProfileMenu.contains(event.target)) {
                    mobileProfileMenu.classList.add('hidden');
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
