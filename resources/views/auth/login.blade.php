@extends('layouts.guest')

@section('content')
<div class="card login-card bg-white">
    <div class="card-body">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark">MLFRP</h2>
            <p class="text-muted small">Manajemen Laboratorium Fisika & Repositori Penelitian</p>
            <hr>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" name="password" required>
            </div>

            <div class="mb-4 d-grid">
                <button type="submit" class="btn btn-primary">
                    MASUK SEKARANG
                </button>
            </div>

            <div class="d-grid">
        {{-- Diubah menjadi link ke halaman awal --}}
            <a href="{{ route('publik.index') }}" class="btn btn-success">
                MASUK TAMU
            </a>
             </div>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted">Masuk Tamu Untuk Tidak Mempunyai Akun</small>
        </div>
    </div>
</div>
@endsection