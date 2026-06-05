@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <div class="my-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center border border-primary border-opacity-25 mx-auto mb-3" style="width: 120px; height: 120px; overflow: hidden;">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" class="w-100 h-100" style="object-fit: cover;">
                        @else
                            <i class="bi bi-person-fill display-1"></i>
                        @endif
                    </div>

                    <form action="{{ route('profile.update_picture') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="profile_picture" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-medium">
                            <i class="bi {{ Auth::user()->profile_picture ? 'bi-pencil-square' : 'bi-upload' }} me-1"></i>
                            {{ Auth::user()->profile_picture ? 'Update Profile Picture' : 'Upload Profile Picture' }}
                        </label>
                        <input type="file" name="profile_picture" id="profile_picture" class="d-none" onchange="this.form.submit()">
                    </form>
                    
                    @error('profile_picture') 
                        <div class="text-danger small mt-2">{{ $message }}</div> 
                    @enderror
                </div>
                
                <h5 class="fw-bold text-dark mb-1">{{ Auth::user()->name }}</h5>
                <p class="text-muted small mb-3">{{ Auth::user()->email }}</p>
                
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2 rounded-pill small fw-semibold">
                    <i class="bi bi-shield-check me-1"></i> Verified Account
                </span>
                
                <hr class="my-4 text-muted opacity-25">
                
                <div class="text-start">
                    <p class="small text-muted mb-2"><i class="bi bi-calendar3 me-2 text-primary"></i>Member since: <span class="text-dark fw-medium">{{ Auth::user()->created_at ? Auth::user()->created_at->format('M d, Y') : 'June 2026' }}</span></p>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100 py-2 rounded-3 btn-sm fw-medium">
                        <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold text-dark mb-1"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Account Details</h5>
                <p class="text-muted small mb-4">Your general identification settings inside the expense platform.</p>
                
                <div class="mb-3">
                    <label class="form-label text-muted small fw-medium mb-1">Your Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0 rounded-start-3 text-muted"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control bg-light border-0 rounded-end-3 py-2" value="{{ Auth::user()->name }}" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small fw-medium mb-1">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0 rounded-start-3 text-muted"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control bg-light border-0 rounded-end-3 py-2" value="{{ Auth::user()->email }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold text-dark mb-1"><i class="bi bi-lock-fill me-2 text-danger"></i>Security Settings</h5>
                <p class="text-muted small mb-3">Update your password to keep your account secure.</p>
                
                @if (session('success'))
                    <div class="alert alert-success small py-2 border-0 mb-3">{{ session('success') }}</div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <input type="password" name="current_password" class="form-control bg-light border-0 rounded-3 py-2" placeholder="Current Password" required>
                        @error('current_password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-2">
                        <input type="password" name="password" class="form-control bg-light border-0 rounded-3 py-2" placeholder="New Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control bg-light border-0 rounded-3 py-2" placeholder="Confirm New Password" required>
                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-2 rounded-3 fw-medium">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection