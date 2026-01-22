@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Ensiklopedia Rumus</h1>
        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TR1">
            <i class="fas fa-plus me-2"></i> Tambah Rumus
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
                    <input type="text" id="inputSearchRumus" class="form-control form-control-sm" placeholder="Cari rumus atau kategori...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Rumus</th>
                            <th>Kategori</th>
                            <th width="250">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelRumusBody">
                        @foreach($semua_rumus as $key => $r)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $r->nama_rumus }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary">{{ $r->kategori }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('rumus.show', $r->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#ER1-{{ $r->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('rumus.destroy', $r->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus rumus ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="ER1-{{ $r->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('rumus.update', $r->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Edit Rumus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <hr class="mx-3">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Rumus</label>
                                                <input type="text" name="nama_rumus" class="form-control" value="{{ $r->nama_rumus }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kategori</label>
                                                <input type="text" name="kategori" class="form-control" value="{{ $r->kategori }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Isi Rumus (Latex/Teks)</label>
                                                <textarea name="isi_rumus" class="form-control" rows="3" required>{{ $r->isi_rumus }}</textarea>
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

                        <tr id="noDataRumus" style="display: none;">
                            <td colspan="4" class="text-center text-muted py-3">Rumus tidak ditemukan...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted" id="summaryRumus">
                    Showing 1 to {{ count($semua_rumus) }} of {{ count($semua_rumus) }} entries
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

<div class="modal fade" id="TR1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('rumus.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Tambah Rumus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <hr class="mx-3">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Rumus</label>
                        <input type="text" name="nama_rumus" class="form-control" placeholder="Contoh: Hukum II Newton" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" placeholder="Contoh: Mekanika" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Rumus</label>
                        <textarea name="isi_rumus" class="form-control" rows="3" placeholder="Masukkan formula rumus" required></textarea>
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
        const searchInput = document.getElementById('inputSearchRumus');
        const tableBody = document.getElementById('tabelRumusBody');
        const rows = tableBody.getElementsByTagName('tr');
        const noDataRow = document.getElementById('noDataRumus');
        const summaryText = document.getElementById('summaryRumus');
        const totalEntries = {{ count($semua_rumus) }};

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let dataDitemukan = false;
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                // Lewati baris pesan "tidak ditemukan"
                if (rows[i] === noDataRow) continue;

                // Cek teks di Nama Rumus dan Kategori
                const rowText = rows[i].textContent.toLowerCase();
                
                if (rowText.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    dataDitemukan = true;
                    visibleCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Tampilkan/sembunyikan pesan tidak ada data
            noDataRow.style.display = dataDitemukan ? "none" : "";

            // Update teks info jumlah data
            if (filter === "") {
                summaryText.innerText = `Showing 1 to ${totalEntries} of ${totalEntries} entries`;
            } else {
                summaryText.innerText = `Found ${visibleCount} matching records`;
            }
        });
    });
</script>
@endsection