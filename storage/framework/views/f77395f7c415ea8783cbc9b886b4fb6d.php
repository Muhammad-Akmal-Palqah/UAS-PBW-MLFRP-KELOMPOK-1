

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Kalender Ketersediaan</h1>
        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TP1">
            <i class="fas fa-plus me-2"></i> Tambah Peminjaman
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
                    <input type="text" id="inputSearchKalender" class="form-control form-control-sm" placeholder="Cari data peminjaman...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Peminjam</th>
                            <th>Prodi</th>
                            <th>Alat/Lab Dipinjam</th>
                            <th>Waktu Peminjaman</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelPeminjamanBody">
                        <?php $__currentLoopData = $semua_peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($key + 1); ?></td>
                            <td class="fw-bold"><?php echo e($p->nama_peminjam); ?></td>
                            <td><?php echo e($p->prodi); ?></td>
                            <td><span class="badge bg-info text-dark"><?php echo e($p->item_pinjam); ?></span></td>
                            <td><?php echo e($p->waktu_pinjam); ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#EP1-<?php echo e($p->id); ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="<?php echo e(route('kalender.destroy', $p->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Hapus data peminjaman ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="EP1-<?php echo e($p->id); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="<?php echo e(route('kalender.update', $p->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Edit Peminjaman</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <hr class="mx-3">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Peminjam</label>
                                                <input type="text" name="nama_peminjam" class="form-control" value="<?php echo e($p->nama_peminjam); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Prodi</label>
                                                <input type="text" name="prodi" class="form-control" value="<?php echo e($p->prodi); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alat/Lab Dipinjam</label>
                                                <input type="text" name="item_pinjam" class="form-control" value="<?php echo e($p->item_pinjam); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Waktu Peminjaman</label>
                                                <input type="text" name="waktu_pinjam" class="form-control" value="<?php echo e($p->waktu_pinjam); ?>" required>
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
                        
                        <tr id="noDataRow" style="display: none;">
                            <td colspan="6" class="text-center text-muted py-3">Data peminjaman tidak ditemukan...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted" id="summaryKalender">
                    Showing 1 to <?php echo e(count($semua_peminjaman)); ?> of <?php echo e(count($semua_peminjaman)); ?> entries
                </span>
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

<div class="modal fade" id="TP1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?php echo e(route('kalender.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Tambah Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <hr class="mx-3">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Peminjam</label>
                        <input type="text" name="nama_peminjam" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <input type="text" name="prodi" class="form-control" placeholder="Program Studi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alat/Lab Dipinjam</label>
                        <input type="text" name="item_pinjam" class="form-control" placeholder="Contoh: Lab Komputer 1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Waktu Peminjaman</label>
                        <input type="text" name="waktu_pinjam" class="form-control" placeholder="Contoh: 19 Jan 2026, 08:00" required>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('inputSearchKalender');
        const tableBody = document.getElementById('tabelPeminjamanBody');
        const rows = tableBody.getElementsByTagName('tr');
        const noDataRow = document.getElementById('noDataRow');
        const summaryText = document.getElementById('summaryKalender');
        const totalEntries = <?php echo e(count($semua_peminjaman)); ?>;

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let foundCount = 0;
            let dataDitemukan = false;

            for (let i = 0; i < rows.length; i++) {
                // Jangan hitung baris "tidak ditemukan"
                if (rows[i] === noDataRow) continue;

                const rowText = rows[i].textContent.toLowerCase();
                
                if (rowText.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    dataDitemukan = true;
                    foundCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Tampilkan baris pesan jika hasil kosong
            noDataRow.style.display = dataDitemukan ? "none" : "";

            // Update info ringkasan data di bawah tabel
            if (filter === "") {
                summaryText.innerText = `Showing 1 to ${totalEntries} of ${totalEntries} entries`;
            } else {
                summaryText.innerText = `Found ${foundCount} matching records`;
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\L\laragon\www\mlfrp\resources\views/admin/kalender/index.blade.php ENDPATH**/ ?>