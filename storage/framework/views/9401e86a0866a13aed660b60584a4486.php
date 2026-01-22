<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MLFRP Admin | Back-end</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <style>
        body { background-color: #f4f7f6; overflow-x: hidden; }
        .sidebar { width: 280px; height: 100vh; position: fixed; background: #fff; border-right: 1px solid #ddd; overflow-y: auto; z-index: 1000; }
        .main-content { margin-left: 280px; padding: 30px; min-height: 100vh; width: calc(100% - 280px);}
        .table { width: 100% !important;}
        .nav-link { color: #444; padding: 12px 20px; border-radius: 8px; margin: 2px 15px; transition: 0.2s; }
        .nav-link:hover, .nav-link.active { background: #e8f0fe; color: #1a73e8; font-weight: 600; }
        /* Style tambahan untuk link yang didisable */
        .nav-link.disabled-sidebar { color: #ccc !important; cursor: not-allowed; background: transparent !important; }
        .dropdown-menu { border: none; shadow: 0 5px 15px rgba(0,0,0,0.1); margin-left: 15px !important; }
        .card-menu { border: none; border-radius: 15px; transition: 0.3s; background: #fff; }
        .card-menu:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
    </style>
</head>
<body>

<div class="d-flex">
    <aside class="sidebar d-flex flex-column p-3">
        <div class="px-3 mb-4 mt-2">
            <h4 class="fw-bold text-primary mb-0">MLFRP ADMIN</h4>
            <small class="text-muted">Laboratorium Fisika</small>
        </div>
        
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/dashboard" class="nav-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">Dashboard</a>
            </li>

            
            <?php if (\Illuminate\Support\Facades\Blade::check('hasrole', 'superadmin')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo e(request()->is('admin/jabatan*', 'admin/user*') ? 'active' : ''); ?>" href="#" id="masterDrop" role="button" data-bs-toggle="dropdown">
                        Master Data
                    </a>
                    <ul class="dropdown-menu shadow w-100">
                        <li><a class="dropdown-item" href="/admin/jabatan">Data Jabatan</a></li>
                        <li><a class="dropdown-item" href="/admin/user">Data User</a></li>
                    </ul>
                </li>
            <?php else: ?>
                
                <li class="nav-item">
                    <a class="nav-link disabled-sidebar" href="javascript:void(0)">
                        <i class="fas fa-lock me-1"></i> Master Data
                    </a>
                </li>
            <?php endif; ?>

            
            <li><a href="/admin/alat" class="nav-link <?php echo e(request()->is('admin/alat*') ? 'active' : ''); ?>">Katalog Alat</a></li>
            <li><a href="/admin/kalender" class="nav-link <?php echo e(request()->is('admin/kalender*') ? 'active' : ''); ?>">Kalender Ketersediaan</a></li>
            <li><a href="/admin/rumus" class="nav-link <?php echo e(request()->is('admin/rumus*') ? 'active' : ''); ?>">Ensiklopedia Rumus</a></li>
            <li><a href="/admin/repositori" class="nav-link <?php echo e(request()->is('admin/repositori*') ? 'active' : ''); ?>">Repositori Publik</a></li>
            <li><a href="/admin/halloffame" class="nav-link <?php echo e(request()->is('admin/halloffame*') ? 'active' : ''); ?>">Hall of Fame</a></li>
            <li><a href="/admin/event" class="nav-link <?php echo e(request()->is('admin/event*') ? 'active' : ''); ?>">Info Event</a></li>
            <li><a href="/admin/modul" class="nav-link <?php echo e(request()->is('admin/modul*') ? 'active' : ''); ?>">Download Modul</a></li>
        </ul>
        
        <hr>
        <div class="px-3 mb-2">
            <small class="text-muted d-block">Login sebagai:</small>
            <span class="badge bg-light text-primary border"><?php echo e(ucfirst(Auth::user()->role ?? 'admin')); ?></span>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>" class="px-3">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-outline-danger w-100 btn-sm">Log Out</button>
        </form>
    </aside>

    <main class="main-content">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>

<script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
</body>
</html><?php /**PATH F:\Laragon\www\mlfrp\resources\views/layouts/app.blade.php ENDPATH**/ ?>