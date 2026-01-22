<?php $__env->startSection('content'); ?>
<div class="card login-card bg-white">
    <div class="card-body">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark">MLFRP</h2>
            <p class="text-muted small">Manajemen Laboratorium Fisika & Repositori Penelitian</p>
            <hr>
        </div>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required autofocus>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
        
            <a href="<?php echo e(route('publik.index')); ?>" class="btn btn-success">
                MASUK TAMU
            </a>
             </div>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted">Masuk Tamu Untuk Tidak Mempunyai Akun</small>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Laragon\www\mlfrp\resources\views/auth/login.blade.php ENDPATH**/ ?>