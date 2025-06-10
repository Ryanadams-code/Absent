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
<body class="bg-surface-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <img class="mx-auto h-24 w-auto" src="/images/logo.svg" alt="KelasKu Logo">
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
                    <div>
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
</body>
</html>
