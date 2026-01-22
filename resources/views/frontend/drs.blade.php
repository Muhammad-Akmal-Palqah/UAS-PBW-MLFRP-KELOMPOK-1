@extends('layouts.publik')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Detail Ensiklopedia Rumus</h2>
    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5">
            <div class="mb-4">
                <span class="badge bg-primary mb-2">{{ $rumus->kategori }}</span>
                <h1 class="fw-bold display-5">{{ $rumus->nama_rumus }}</h1>
            </div>
            
            <div class="bg-light p-4 rounded-3 mb-4 text-center">
                <h3 class="text-muted mb-3">Formula:</h3>
                <div class="display-4 fw-bold text-dark">
                    {{ $rumus->isi_rumus }}
                </div>
            </div>

            <hr class="my-4">
            <a href="{{ route('publik.rumus') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke List
            </a>
        </div>
    </div>
</div>
@endsection