@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Hall Of Fame</h1>
        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TT1">
            <i class="fas fa-plus me-2"></i> Tambah Tokoh
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
                    <input type="text" id="searchTokoh" class="form-control form-control-sm" placeholder="Cari nama tokoh...">
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
                    <tbody id="tokohTableBody">
                        @foreach($semua_tokoh as $key => $t)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="fw-bold">{{ $t->nama_tokoh }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/'.$t->foto) }}" width="80" class="rounded shadow-sm border">
                            </td>
                            <td class="text-center">
                                <a href="{{ route('halloffame.show', $t->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#ET1-{{ $t->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('halloffame.destroy', $t->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus tokoh ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="ET1-{{ $t->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('halloffame.update', $t->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Edit Tokoh</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <hr class="mx-3">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Tokoh</label>
                                                <input type="text" name="nama_tokoh" class="form-control" value="{{ $t->nama_tokoh }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Upload Gambar Baru</label>
                                                <input type="file" name="foto" class="form-control">
                                                <small class="text-muted small">Kosongkan jika tidak ingin mengubah foto.</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi Tokoh</label>
                                                <textarea name="deskripsi" class="form-control" rows="4">{{ $t->deskripsi }}</textarea>
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

                        <tr id="noResults" style="display: none;">
                            <td colspan="4" class="text-center text-muted py-3">Tokoh tidak ditemukan...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted" id="summaryTokoh">
                    Showing 1 to {{ count($semua_tokoh) }} of {{ count($semua_tokoh) }} entries
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

<div class="modal fade" id="TT1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('halloffame.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchTokoh');
        const tableBody = document.getElementById('tokohTableBody');
        const rows = tableBody.getElementsByTagName('tr');
        const noResults = document.getElementById('noResults');
        const summaryText = document.getElementById('summaryTokoh');
        const totalEntries = {{ count($semua_tokoh) }};

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let foundCount = 0;
            let hasVisibleRow = false;

            for (let i = 0; i < rows.length; i++) {
                if (rows[i] === noResults) continue;

                // Menggunakan textContent untuk mencari di seluruh kolom baris tersebut
                const textValue = rows[i].textContent.toLowerCase();
                
                if (textValue.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    hasVisibleRow = true;
                    foundCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Tampilkan pesan jika tidak ada hasil
            noResults.style.display = hasVisibleRow ? "none" : "";

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