@extends('layouts.publik')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Detail Tokoh Fisikawan</h2>
    
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('storage/'.$tokoh->foto) }}" class="img-fluid h-100" style="object-fit: cover;" alt="{{ $tokoh->nama_tokoh }}">
            </div>
            <div class="col-md-8">
                <div class="card-body p-5">
                    <h3 class="fw-bold text-decoration-underline mb-4">{{ $tokoh->nama_tokoh }}</h3>
                    <div class="text-muted" style="line-height: 1.8;">
                        {!! nl2br(e($tokoh->deskripsi)) !!}
                    </div>
                    <hr class="my-4">
                    <a href="{{ route('publik.halloffame') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection