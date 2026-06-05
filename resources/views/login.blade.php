@extends('layouts.main')

@section('content')

    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card p-4 col-sm-5 col-md-5 col-lg-4 shadow-lg border-0 rounded-4">
            
            <div class="text-center mb-4">
                <div class="mb-2">
                    <img src="{{ asset('img/logo.png') }}" 
                         alt="My Wallet Logo" 
                         class="img-fluid" 
                         style="max-height: 60px; object-fit: contain;">
                </div>
                
                <h4 class="fw-bold text-dark mb-1">Welcome Back</h4>
                <p class="text-muted small">Log in to manage your personal budget, check your balance, and log your expenses.</p>
            </div>
            
            @if (session('success'))
                <div class="alert alert-success small py-2 rounded-3 border-0 text-center shadow-sm mb-3" role="alert">
                    <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('login') }}" method="POST">
                @csrf {{-- Laravel security token --}}

                <div class="form-floating mb-3">
                    <input type="email" 
                           name="email" 
                           class="form-control rounded-3 @error('email') is-invalid @enderror" 
                           id="email" 
                           placeholder="name@example.com" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus>
                    <label for="email" class="text-muted small"><i class="bi bi-envelope me-2"></i>Email Address</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" 
                           name="password" 
                           class="form-control rounded-3 @error('password') is-invalid @enderror" 
                           id="password" 
                           placeholder="Password" 
                           required>
                    <label for="password" class="text-muted small"><i class="bi bi-lock me-2"></i>Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check text-start mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                    <label class="form-check-label text-muted small" for="rememberMe">
                        Remember this device
                    </label>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-medium shadow-sm">
                        Log In <i class="bi bi-box-arrow-in-right ms-1"></i>
                    </button>
                </div>

                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-primary fw-medium text-decoration-none">Create one here</a></p>
                </div>
            </form>
        </div>
    </div>

@endsection