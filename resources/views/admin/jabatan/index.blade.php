@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">JABATAN</h1>
        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TJ1">
            <i class="fas fa-plus me-2"></i> Tambah Jabatan
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
                    <input type="text" id="inputSearchJabatan" class="form-control form-control-sm" placeholder="Cari jabatan...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th width="50">No</th>
                            <th>Nama Jabatan</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelJabatanBody">
                        @foreach($semua_jabatan as $key => $j)
                        <tr>
                            <td class="text-center no-index">{{ $key + 1 }}</td>
                            <td class="nama-jabatan">{{ $j->nama_jabatan }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#EJ1-{{ $j->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('jabatan.destroy', $j->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="EJ1-{{ $j->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('jabatan.update', $j->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Edit Jabatan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <hr class="mx-3">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Jabatan</label>
                                                <input type="text" name="nama_jabatan" class="form-control" value="{{ $j->nama_jabatan }}" required>
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
                        @endforeach
                        
                        <tr id="rowKosong" style="display: none;">
                            <td colspan="3" class="text-center text-muted py-3">Data jabatan tidak ditemukan...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted" id="summaryJabatan">
                    Showing 1 to {{ count($semua_jabatan) }} of {{ count($semua_jabatan) }} entries
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

<div class="modal fade" id="TJ1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('jabatan.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Tambah Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <hr class="mx-3">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" placeholder="Masukkan nama jabatan" required>
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
        const searchInput = document.getElementById('inputSearchJabatan');
        const tableBody = document.getElementById('tabelJabatanBody');
        const rows = tableBody.getElementsByTagName('tr');
        const emptyRow = document.getElementById('rowKosong');
        const summaryText = document.getElementById('summaryJabatan');
        const totalEntries = {{ count($semua_jabatan) }};

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let foundCount = 0;
            let dataDitemukan = false;

            for (let i = 0; i < rows.length; i++) {
                if (rows[i] === emptyRow) continue;

                // Menggunakan textContent dari seluruh baris agar pencarian lebih fleksibel
                const txtValue = rows[i].textContent.toLowerCase();
                
                if (txtValue.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    dataDitemukan = true;
                    foundCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Tampilkan pesan jika tidak ada hasil
            emptyRow.style.display = dataDitemukan ? "none" : "";

            // Update info ringkasan data secara dinamis
            if (filter === "") {
                summaryText.innerText = `Showing 1 to ${totalEntries} of ${totalEntries} entries`;
            } else {
                summaryText.innerText = `Found ${foundCount} matching records`;
            }
        });
    });
</script>
@endsection