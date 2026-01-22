@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Detail Katalog Alat</h2>
    
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="row g-0">
            <div class="col-md-4 bg-white d-flex align-items-center justify-content-center p-3">
                <img src="{{ asset('storage/'.$alat->gambar) }}" class="img-fluid rounded" style="max-height: 400px;" alt="{{ $alat->nama_barang }}">
            </div>
            <div class="col-md-8">
                <div class="card-body p-5">
                    <h3 class="fw-bold text-decoration-underline mb-4">{{ $alat->nama_barang }}</h3>
                    <div class="text-muted" style="line-height: 1.8;">
                        {!! nl2br(e($alat->deskripsi)) !!}
                    </div>
                    <hr class="my-4">
                    <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection