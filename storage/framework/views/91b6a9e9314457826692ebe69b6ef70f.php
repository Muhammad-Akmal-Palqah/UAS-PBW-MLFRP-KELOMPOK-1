

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Detail Ensiklopedia Rumus</h2>
    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5">
            <div class="mb-4">
                <span class="badge bg-primary mb-2"><?php echo e($rumus->kategori); ?></span>
                <h1 class="fw-bold display-5"><?php echo e($rumus->nama_rumus); ?></h1>
            </div>
            
            <div class="bg-light p-4 rounded-3 mb-4 text-center">
                <h3 class="text-muted mb-3">Formula:</h3>
                <div class="display-4 fw-bold text-dark">
                    <?php echo e($rumus->isi_rumus); ?>

                </div>
            </div>

            <hr class="my-4">
            <a href="<?php echo e(route('publik.rumus')); ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke List
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publik', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Laragon\www\mlfrp\resources\views/frontend/drs.blade.php ENDPATH**/ ?>