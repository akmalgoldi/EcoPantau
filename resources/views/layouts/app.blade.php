<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EcoPantau') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- HAPUS BLOK <style> INI DAN SEMUA GAYA DARI BLOK <style> SEKARANG ADA DI resources/sass/_custom.scss --}}
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100"> {{-- Tambahkan class ini untuk sticky footer --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand text-dark" href="{{ Auth::check() ? url('/home') : url('/') }}">
                    {{-- Anda bisa ganti dengan <img> logo Anda di sini --}}
                    {{ config('app.name', 'EcoPantau') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if (Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.reports.index') }}">Kelola Laporan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.users.index') }}">Kelola Pengguna</a>
                                </li>
                            @elseif (Auth::user()->isUser())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard Warga</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.reports.create') }}">Buat Laporan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.reports.my') }}">Laporan Saya</a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->isUser())
                                        <a class="dropdown-item" href="{{ route('user.profile.edit') }}">Profil</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 flex-grow-1"> {{-- Tambahkan class ini untuk sticky footer --}}
            @yield('content')
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-dark">Copyright &copy; {{ config('app.name', 'EcoPantau') }} {{ date('Y') }}</div></div>
                    <div class="col-auto">
                        <a class="link-dark small" href="#">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-dark small" href="#">Terms</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-dark small" href="#">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @yield('scripts')
</body>
</html>