

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Hall Of Fame</h1>
        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TT1">
            <i class="fas fa-plus me-2"></i> Tambah Tokoh
        </button>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            
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
                            <th>Nama Tokoh</th>
                            <th>Gambar Tokoh</th>
                            <th width="250">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $semua_tokoh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($key + 1); ?></td>
                            <td><?php echo e($t->nama_tokoh); ?></td>
                            <td class="text-center">
                                <img src="<?php echo e(asset('storage/'.$t->foto)); ?>" width="80" class="rounded shadow-sm">
                            </td>
                            <td class="text-center">
                                <a href="<?php echo e(route('halloffame.show', $t->id)); ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#ET1-<?php echo e($t->id); ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="<?php echo e(route('halloffame.destroy', $t->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus tokoh ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="ET1-<?php echo e($t->id); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="<?php echo e(route('halloffame.update', $t->id)); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Edit Tokoh</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <hr class="mx-3">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Tokoh</label>
                                                <input type="text" name="nama_tokoh" class="form-control" value="<?php echo e($t->nama_tokoh); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Upload Gambar Baru</label>
                                                <input type="file" name="foto" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi Tokoh</label>
                                                <textarea name="deskripsi" class="form-control" rows="4"><?php echo e($t->deskripsi); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-danger btn-sm px-3" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm px-3">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted">Showing 1 to <?php echo e(count($semua_tokoh)); ?> of <?php echo e(count($semua_tokoh)); ?> entries</span>
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

<div class="modal fade" id="TT1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?php echo e(route('halloffame.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Tambah Tokoh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <hr class="mx-3">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Tokoh</label>
                        <input type="text" name="nama_tokoh" class="form-control" placeholder="Masukkan nama tokoh" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Gambar</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Tokoh</label>
                        <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsi Tokoh"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-danger btn-sm px-3" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm px-3">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Laragon\www\mlfrp\resources\views/admin/halloffame/index.blade.php ENDPATH**/ ?>