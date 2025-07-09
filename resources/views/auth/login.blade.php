<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KelasKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
</head>
<body class="min-h-screen h-screen bg-surface-50 flex items-center justify-center font-['Roboto']">
    <div class="flex w-full h-full max-w-full mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Bagian kiri: gambar -->
        <div class="w-1/2 bg-gray-100 flex items-center justify-center p-8">
            <img src="{{ asset('images/tutorprofessor.svg') }}" alt="Ilustrasi Login" class="w-3/4 h-auto object-contain">
        </div>

        <!-- Bagian kanan: form login -->
        <div class="w-1/2 flex p-8 items-center justify-center">
            <div class="w-full max-w-md space-y-8 px-6">
                <div class="text-center mb-6">
                    <img class="mx-auto h-20 w-auto" src="{{ asset('images/logo.png') }}" alt="KelasKu Logo">
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">Masuk ke Akun Anda</h2>
                    <p class="mt-2 text-sm text-gray-600">Sistem Absensi Sekolah</p>
                </div>

                @if ($errors->any())
                    <div class="rounded-md bg-danger-50 p-4 mt-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <span class="material-icons-round text-danger-400">error_outline</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-danger-800">Terdapat beberapa kesalahan:</h3>
                                <div class="mt-2 text-sm text-danger-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div class="relative">
                            <label for="email" class="sr-only">Email</label>
                            <div class="flex items-center">
                                <span class="material-icons-round text-gray-400 absolute ml-3">email</span>
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                    class="appearance-none rounded-t-md relative block w-full px-12 py-3 border border-gray-300 
                                    placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary-500 
                                    focus:border-primary-500 focus:z-10" 
                                    placeholder="Email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <div class="flex items-center">
                                <span class="material-icons-round text-gray-400 absolute ml-3">lock</span>
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                    class="appearance-none rounded-b-md relative block w-full px-12 py-3 border border-gray-300 
                                    placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary-500 
                                    focus:border-primary-500 focus:z-10" 
                                    placeholder="Password">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" 
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">
                                Ingat Saya
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-primary-600 hover:text-primary-500">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent 
                            text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 
                            transition-colors duration-200">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <span class="material-icons-round text-primary-300 group-hover:text-primary-200">login</span>
                            </span>
                            Masuk
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
