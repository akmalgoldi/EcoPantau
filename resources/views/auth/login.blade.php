@extends('layouts.app')

@section('content')

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            Masuk ke EcoPantau
        </div>
        <div class="card-body">
            <div class="login-logo">
                {{-- Anda bisa menempatkan logo gambar di sini jika punya --}}
                {{-- <img src="{{ asset('images/your-logo.png') }}" alt="EcoPantau Logo"> --}}
                <h1>{{ config('app.name', 'EcoPantau') }}</h1>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>

                @if (Route::has('password.request'))
                    <a class="forgot-password-link text-muted" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                @if (Route::has('register'))
                    <a class="register-link text-muted" href="{{ route('register') }}">
                        Belum punya akun? Daftar di sini.
                    </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection