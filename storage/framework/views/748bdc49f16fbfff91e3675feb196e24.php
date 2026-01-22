

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Manajemen Repositori</h1>
        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TJ1">
            <i class="fas fa-plus me-2"></i> Tambah Jurnal
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
                            <th>Judul Jurnal/Artikel</th>
                            <th>Penulis</th>
                            <th>Keyword</th>
                            <th width="250">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $semua_jurnal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($key + 1); ?></td>
                            <td class="fw-bold"><?php echo e($j->judul); ?></td>
                            <td><?php echo e($j->penulis); ?></td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark"><?php echo e($j->keyword); ?></span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#EJ1-<?php echo e($j->id); ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <form action="<?php echo e(route('repositori.destroy', $j->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Hapus jurnal ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>

                                <?php if($j->file_jurnal): ?>
                                <a href="<?php echo e(asset('storage/' . $j->file_jurnal)); ?>" target="_blank" class="btn btn-primary btn-sm shadow-sm">
                                    <i class="fas fa-eye"></i> Baca
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <div class="modal fade" id="EJ1-<?php echo e($j->id); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="<?php echo e(route('repositori.update', $j->id)); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Edit Jurnal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <hr class="mx-3">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Judul Jurnal</label>
                                                <input type="text" name="judul" class="form-control" value="<?php echo e($j->judul); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Penulis</label>
                                                <textarea name="penulis" class="form-control" rows="2" required><?php echo e($j->penulis); ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Keyword</label>
                                                <input type="text" name="keyword" class="form-control" value="<?php echo e($j->keyword); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Ganti File Jurnal (PDF)</label>
                                                <input type="file" name="file_jurnal" class="form-control" accept=".pdf">
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan Perubahan</button>
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
                <span class="small text-muted">Showing 1 to <?php echo e(count($semua_jurnal)); ?> of <?php echo e(count($semua_jurnal)); ?> entries</span>
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

<div class="modal fade" id="TJ1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?php echo e(route('repositori.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Tambah Jurnal Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <hr class="mx-3">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Jurnal</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul jurnal" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Penulis</label>
                        <textarea name="penulis" class="form-control" rows="2" placeholder="Nama penulis..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keyword</label>
                        <input type="text" name="keyword" class="form-control" placeholder="Contoh: Fisika, Nuklir, Lab" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload File Jurnal (PDF)</label>
                        <input type="file" name="file_jurnal" class="form-control" accept=".pdf" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Laragon\www\mlfrp\resources\views/admin/repositori/index.blade.php ENDPATH**/ ?>