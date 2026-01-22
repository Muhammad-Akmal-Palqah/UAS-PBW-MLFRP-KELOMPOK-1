

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Katalog Alat</h1>
        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TKA1">
            <i class="fas fa-plus me-2"></i> Tambah Alat
        </button>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
             <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <span>Show</span>
                    <select class="form-select form-select-sm mx-2" style="width: auto;">
                        <option>10</option>
                    </select>
                    <span>entries</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-2">Search:</span>
                    <input type="text" class="form-control form-control-sm">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Barang</th>
                            <th>Gambar Barang</th>
                            <th width="250">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $semua_alat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($key + 1); ?></td>
                            <td><?php echo e($a->nama_barang); ?></td>
                            <td class="text-center">
                                <img src="<?php echo e(asset('storage/'.$a->gambar)); ?>" width="80" class="rounded shadow-sm">
                            </td>
                            <td class="text-center">
                                <a href="<?php echo e(route('publik.katalog.show', $a->id)); ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted">Showing 1 to <?php echo e(count($semua_alat)); ?> of <?php echo e(count($semua_alat)); ?> entries</span>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publik', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Laragon\www\mlfrp\resources\views/frontend/alat.blade.php ENDPATH**/ ?>