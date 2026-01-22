@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Info Event</h1>
        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TE1">
            <i class="fas fa-plus me-2"></i> Tambah Event
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
                    <input type="text" id="inputSearchEvent" class="form-control form-control-sm" placeholder="Cari event atau lokasi...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Event</th>
                            <th>Tanggal Event</th>
                            <th>Lokasi</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelEventBody">
                        @foreach($semua_event as $key => $e)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="fw-bold">{{ $e->nama_event }}</td>
                            <td class="text-center">{{ $e->tanggal_event }}</td>
                            <td>{{ $e->lokasi }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#EE1-{{ $e->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('event.destroy', $e->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus event ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="EE1-{{ $e->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('event.update', $e->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Edit Info Event</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <hr class="mx-3">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Event</label>
                                                <input type="text" name="nama_event" class="form-control" value="{{ $e->nama_event }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Event</label>
                                                <input type="date" name="tanggal_event" class="form-control" value="{{ $e->tanggal_event }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Lokasi</label>
                                                <input type="text" name="lokasi" class="form-control" value="{{ $e->lokasi }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <tr id="noDataEvent" style="display: none;">
                            <td colspan="5" class="text-center text-muted py-3">Data event tidak ditemukan...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted" id="summaryEvent">
                    Showing 1 to {{ count($semua_event) }} of {{ count($semua_event) }} entries
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

<div class="modal fade" id="TE1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('event.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Tambah Info Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <hr class="mx-3">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Event</label>
                        <input type="text" name="nama_event" class="form-control" placeholder="Contoh: Webinar Fisika Modern" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Event</label>
                        <input type="date" name="tanggal_event" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Lab Fisika Dasar / Zoom" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('inputSearchEvent');
        const tableBody = document.getElementById('tabelEventBody');
        const rows = tableBody.getElementsByTagName('tr');
        const noDataRow = document.getElementById('noDataEvent');
        const summaryText = document.getElementById('summaryEvent');
        const totalEntries = {{ count($semua_event) }};

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let dataDitemukan = false;
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                // Lewati baris "tidak ditemukan"
                if (rows[i] === noDataRow) continue;

                // Mengambil seluruh teks dalam baris (Nama Event + Tanggal + Lokasi)
                const rowText = rows[i].textContent.toLowerCase();
                
                if (rowText.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    dataDitemukan = true;
                    visibleCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Tampilkan pesan jika hasil pencarian kosong
            noDataRow.style.display = dataDitemukan ? "none" : "";

            // Update info summary di bawah tabel
            if (filter === "") {
                summaryText.innerText = `Showing 1 to ${totalEntries} of ${totalEntries} entries`;
            } else {
                summaryText.innerText = `Found ${visibleCount} matching records`;
            }
        });
    });
</script>
@endsection