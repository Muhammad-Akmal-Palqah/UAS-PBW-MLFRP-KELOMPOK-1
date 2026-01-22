<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MLFRP | Publik</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body { background-color: #f4f7f6; overflow-x: hidden; }
        .sidebar { width: 280px; height: 100vh; position: fixed; background: #fff; border-right: 1px solid #ddd; overflow-y: auto; z-index: 1000; }
        .main-content { margin-left: 280px; padding: 30px; min-height: 100vh; width: calc(100% - 280px);}
        .nav-link { color: #444; padding: 12px 20px; border-radius: 8px; margin: 2px 15px; transition: 0.2s; }
        .nav-link:hover, .nav-link.active { background: #e8f0fe; color: #1a73e8; font-weight: 600; }
        .card-menu { border: none; border-radius: 15px; transition: 0.3s; background: #fff; }
        .card-menu:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
    </style>
</head>
<body>

<div class="d-flex">
    <aside class="sidebar d-flex flex-column p-3">
        <div class="px-3 mb-4 mt-2">
            <h4 class="fw-bold text-success mb-0">MLFRP PUBLIC</h4>
            <small class="text-muted">Laboratorium Fisika</small>
        </div>
        
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('publik.index') }}" class="nav-link active">Dashboard</a>
            </li>


            <li><a href="{{ route('publik.katalog.alat') }}" class="nav-link">Katalog Alat</a></li>
            <li><a href="{{ route('publik.kalender') }}" class="nav-link">Kalender Ketersediaan</a></li>
            <li><a href="{{ route('publik.rumus') }}" class="nav-link">Ensiklopedia Rumus</a></li>
            <li><a href="{{ route('publik.repositori') }}" class="nav-link">Repositori Publik</a></li>
            <li><a href="{{ route('publik.halloffame') }}" class="nav-link">Hall of Fame</a></li>
            <li><a href="{{ route('publik.event') }}" class="nav-link">Info Event</a></li>
            <li><a href="{{ route('publik.modul') }}" class="nav-link">Download Modul</a></li>
        </ul>
        
        <hr>
        <div class="px-3">
            <a href="{{ route('login') }}" class="btn btn-primary w-100 btn-sm">Login Petugas</a>
        </div>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>