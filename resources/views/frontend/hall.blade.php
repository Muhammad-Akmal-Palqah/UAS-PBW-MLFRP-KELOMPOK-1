@extends('layouts.publik')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Hall Of Fame</h1>
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
                    <input type="text" id="searchHof" class="form-control form-control-sm" placeholder="Cari nama tokoh...">
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
                    <tbody id="hofTableBody">
                        @foreach($semua_tokoh as $key => $t)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="fw-bold">{{ $t->nama_tokoh }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/'.$t->foto) }}" width="80" class="rounded shadow-sm">
                            </td>
                            <td class="text-center">
                                <a href="{{ route('publik.halloffame.show', $t->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        <tr id="noResults" style="display: none;">
                            <td colspan="4" class="text-center text-muted py-3">Tokoh tidak ditemukan...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted" id="summaryHof">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchHof');
        const tableBody = document.getElementById('hofTableBody');
        const rows = tableBody.getElementsByTagName('tr');
        const noResults = document.getElementById('noResults');
        const summaryText = document.getElementById('summaryHof');
        const totalEntries = {{ count($semua_tokoh) }};

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let foundCount = 0;
            let hasVisibleRow = false;

            for (let i = 0; i < rows.length; i++) {
                // Lewati baris pesan "tidak ditemukan"
                if (rows[i] === noResults) continue;

                // Mencari teks di kolom Nama Tokoh (index 1)
                const textValue = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                
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