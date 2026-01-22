@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Download Modul</h1>
        <button type="button" class="btn btn-success px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TM1">
            <i class="fas fa-upload me-2"></i> Upload Modul
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
                    <input type="text" id="inputSearchModul" class="form-control form-control-sm" placeholder="Cari modul atau kategori...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Modul</th>
                            <th>Kategori</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelModulBody">
                        @foreach($semua_modul as $key => $m)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="fw-bold">{{ $m->nama_modul }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $m->kategori }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ asset('storage/'.$m->file_path) }}" class="btn btn-info btn-sm text-white" target="_blank">
                                    <i class="fas fa-download"></i> Download
                                </a>
                                <form action="{{ route('modul.destroy', $m->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus modul ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                        <tr id="noDataModul" style="display: none;">
                            <td colspan="4" class="text-center text-muted py-3">Modul tidak ditemukan...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted" id="summaryModul">
                    Showing 1 to {{ count($semua_modul) }} of {{ count($semua_modul) }} entries
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

<div class="modal fade" id="TM1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('modul.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Upload Modul Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <hr class="mx-3">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Modul</label>
                        <input type="text" name="nama_modul" class="form-control" placeholder="Contoh: Modul Praktikum Optik" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Fisika Dasar">Fisika Dasar</option>
                            <option value="Fisika Modern">Fisika Modern</option>
                            <option value="Elektronika">Elektronika</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih File (PDF/Docx)</label>
                        <input type="file" name="file_modul" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Upload Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('inputSearchModul');
        const tableBody = document.getElementById('tabelModulBody');
        const rows = tableBody.getElementsByTagName('tr');
        const noDataRow = document.getElementById('noDataModul');
        const summaryText = document.getElementById('summaryModul');
        const totalEntries = {{ count($semua_modul) }};

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let dataDitemukan = false;
            let foundCount = 0;

            for (let i = 0; i < rows.length; i++) {
                // Lewati baris pesan "tidak ditemukan"
                if (rows[i] === noDataRow) continue;

                // Cek teks di seluruh isi baris
                const rowText = rows[i].textContent.toLowerCase();
                
                if (rowText.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    dataDitemukan = true;
                    foundCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Tampilkan baris pesan jika hasil pencarian nihil
            noDataRow.style.display = dataDitemukan ? "none" : "";

            // Update info ringkasan data di bawah tabel secara dinamis
            if (filter === "") {
                summaryText.innerText = `Showing 1 to ${totalEntries} of ${totalEntries} entries`;
            } else {
                summaryText.innerText = `Found ${foundCount} matching records`;
            }
        });
    });
</script>
@endsection