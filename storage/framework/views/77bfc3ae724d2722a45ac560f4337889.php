

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="mb-5">
        <h2 class="fw-bold text-dark">Dashboard</h2>
        <p class="text-muted small text-uppercase">Management Laboratorium Fisika</p>
    </div>

    <div class="row g-4">
        

        <div class="col-md-6 col-lg-4">
            <div class="card card-menu shadow-sm h-100 p-3">
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">Katalog Alat</h5>
                    <p class="text-muted small flex-grow-1">Daftar inventaris alat laboratorium secara detail.</p>
                    <a href="<?php echo e(route('publik.katalog.alat')); ?>" class="btn btn-outline-success btn-sm w-100 mt-3">Buka Katalog</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card card-menu shadow-sm h-100 p-3">
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">Kalender Ketersediaan</h5>
                    <p class="text-muted small flex-grow-1">Pantau jadwal peminjaman alat dan ruangan lab.</p>
                    <a href="<?php echo e(route('publik.kalender')); ?>" class="btn btn-outline-success btn-sm w-100 mt-3">Cek Kalender</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card card-menu shadow-sm h-100 p-3">
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">Ensiklopedia Rumus</h5>
                    <p class="text-muted small flex-grow-1">Pusat penyimpanan Rumus </p>
                    <a href="<?php echo e(route('publik.rumus')); ?>" class="btn btn-outline-success btn-sm w-100 mt-3">Lihat Rumus</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card card-menu shadow-sm h-100 p-3">
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">Repositori Publik</h5>
                    <p class="text-muted small flex-grow-1">Pusat penyimpanan jurnal dan hasil penelitian.</p>
                    <a href="<?php echo e(route('publik.repositori')); ?>" class="btn btn-outline-success btn-sm w-100 mt-3">Lihat Arsip</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card card-menu shadow-sm h-100 p-3">
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">Hall of Fame</h5>
                    <p class="text-muted small flex-grow-1">Data tokoh fisikawan dan penghargaan penelitian.</p>
                    <a href="<?php echo e(route('publik.halloffame')); ?>" class="btn btn-outline-success btn-sm w-100 mt-3">Buka Data</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card card-menu shadow-sm h-100 p-3">
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">Info Event</h5>
                    <p class="text-muted small flex-grow-1">Pengaturan berita dan pengumuman lab terbaru.</p>
                    <a href="<?php echo e(route('publik.event')); ?>" class="btn btn-outline-success btn-sm w-100 mt-3">Lihat Event</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card card-menu shadow-sm h-100 p-3">
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">Download Modul</h5>
                    <p class="text-muted small flex-grow-1">Manajemen file panduan dan modul praktikum.</p>
                    <a href="<?php echo e(route('publik.modul')); ?>" class="btn btn-outline-success btn-sm w-100 mt-3">Lihat Modul</a>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publik', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Laragon\www\mlfrp\resources\views/frontend/index.blade.php ENDPATH**/ ?>