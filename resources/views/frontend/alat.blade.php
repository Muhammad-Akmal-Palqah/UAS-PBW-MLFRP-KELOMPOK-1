@extends('layouts.publik')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Katalog Alat</h1>
        {{-- Tombol tambah biasanya disembunyikan di halaman publik, tapi saya biarkan sesuai code asalmu --}}
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
                    <input type="text" id="inputSearchPublik" class="form-control form-control-sm" placeholder="Cari alat...">
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
                    <tbody id="tabelAlatPublik">
                        @foreach($semua_alat as $key => $a)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="fw-bold">{{ $a->nama_barang }}</td>
                            <td class="text-center">
                                @if($a->gambar)
                                    <img src="{{ asset('storage/'.$a->gambar) }}" width="80" class="rounded shadow-sm">
                                @else
                                    <span class="text-muted small">No Image</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('publik.katalog.show', $a->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                        {{-- Baris No Data --}}
                        <tr id="noResults" style="display: none;">
                            <td colspan="4" class="text-center text-muted py-3">Data alat tidak ditemukan...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted" id="summaryAlat">
                    Showing 1 to {{ count($semua_alat) }} of {{ count($semua_alat) }} entries
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('inputSearchPublik');
        const tableBody = document.getElementById('tabelAlatPublik');
        const rows = tableBody.getElementsByTagName('tr');
        const noResults = document.getElementById('noResults');
        const summaryText = document.getElementById('summaryAlat');
        const totalEntries = {{ count($semua_alat) }};

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let foundCount = 0;
            let hasVisibleRow = false;

            for (let i = 0; i < rows.length; i++) {
                // Lewati baris "no results"
                if (rows[i] === noResults) continue;

                // Mencari teks di kolom Nama Barang (index 1)
                const textValue = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                
                if (textValue.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    hasVisibleRow = true;
                    foundCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Tampilkan pesan jika tidak ada hasil pencarian
            noResults.style.display = hasVisibleRow ? "none" : "";

            // Update info ringkasan secara dinamis
            if (filter === "") {
                summaryText.innerText = `Showing 1 to ${totalEntries} of ${totalEntries} entries`;
            } else {
                summaryText.innerText = `Found ${foundCount} matching records`;
            }
        });
    });
</script>
@endsection