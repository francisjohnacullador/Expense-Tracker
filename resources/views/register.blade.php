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
                
                <h4 class="fw-bold text-dark mb-1">My Wallet</h4>
                <p class="text-muted small">Create your personal account to start tracking your income, expenses, and savings.</p>
            </div>
            
            <form action="{{ route('register') }}" method="POST">
                @csrf {{-- Laravel security token against CSRF attacks --}}

                <div class="form-floating mb-3">
                    <input type="text" 
                           name="name" 
                           class="form-control rounded-3 @error('name') is-invalid @enderror" 
                           id="fullname" 
                           placeholder="John Doe" 
                           value="{{ old('name') }}" 
                           required>
                    <label for="fullname" class="text-muted small"><i class="bi bi-person me-2"></i>Your Name</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" 
                           name="email" 
                           class="form-control rounded-3 @error('email') is-invalid @enderror" 
                           id="email" 
                           placeholder="name@example.com" 
                           value="{{ old('email') }}" 
                           required>
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
                    <label for="password" class="text-muted small"><i class="bi bi-lock me-2"></i>Create Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" 
                           name="password_confirmation" 
                           class="form-control rounded-3" 
                           id="confirmpassword" 
                           placeholder="Confirm Password" 
                           required>
                    <label for="confirmpassword" class="text-muted small"><i class="bi bi-shield-check me-2"></i>Confirm Password</label>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-medium shadow-sm">
                        Start Budgeting <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>

                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-medium text-decoration-none">Log In here</a></p>
                </div>
            </form>
        </div>
    </div>

@endsection