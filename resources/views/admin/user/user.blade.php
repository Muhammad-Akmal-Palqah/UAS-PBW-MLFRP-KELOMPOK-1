@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold h2 text-uppercase">Manajemen User</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#TU1">
            <i class="fas fa-plus me-2"></i> Tambah User
        </button>
    </div>

    <div class="card shadow-sm border-0 w-100">
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
                    <input type="text" id="inputSearchUser" class="form-control form-control-sm" placeholder="Cari username, role, atau jabatan...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle w-100">
                    <thead class="bg-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Jabatan</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelUserBody">
                        @foreach($semua_user as $key => $u)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $u->name }}</td>
                            <td class="text-center">
                                @if($u->hasRole('superadmin'))
                                    <span class="badge bg-primary">Superadmin</span>
                                @else
                                    <span class="badge bg-secondary">Admin</span>
                                @endif
                            </td>
                            <td>{{ $u->jabatan->nama_jabatan ?? 'N/A' }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#EU1-{{ $u->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                
                                <form action="{{ route('user.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Hapus user ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="EU1-{{ $u->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('user.update', $u->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">Edit User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <hr class="mx-3">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" name="name" class="form-control" value="{{ $u->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ganti">
                                                <small class="text-muted">Minimal 6 karakter jika ingin mengganti</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password Verify</label>
                                                <input type="password" name="password_confirmation" class="form-control">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Role Akses</label>
                                                <select name="role" class="form-select" required>
                                                    <option value="superadmin" {{ $u->hasRole('superadmin') ? 'selected' : '' }}>Superadmin</option>
                                                    <option value="admin" {{ $u->hasRole('admin') ? 'selected' : '' }}>Admin Biasa</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Jabatan</label>
                                                <select name="jabatan_id" class="form-select">
                                                    @foreach($semua_jabatan as $j)
                                                        <option value="{{ $j->id }}" {{ $u->jabatan_id == $j->id ? 'selected' : '' }}>
                                                            {{ $j->nama_jabatan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-danger btn-sm px-3" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-1"></i> Close
                                            </button>
                                            <button type="submit" class="btn btn-primary btn-sm px-3 shadow-sm">
                                                <i class="fas fa-save me-1"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <tr id="noDataUser" style="display: none;">
                            <td colspan="5" class="text-center text-muted py-3">Data user tidak ditemukan...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="small text-muted" id="summaryUser">
                    Showing 1 to {{ count($semua_user) }} of {{ count($semua_user) }} entries
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

<div class="modal fade" id="TU1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <hr class="mx-3">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Verify</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role Akses</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="superadmin">Superadmin</option>
                            <option value="admin">Admin Biasa</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Jabatan</label>
                        <select name="jabatan_id" class="form-select" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($semua_jabatan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-danger btn-sm px-3" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm px-3 shadow-sm">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('inputSearchUser');
        const tableBody = document.getElementById('tabelUserBody');
        const rows = tableBody.getElementsByTagName('tr');
        const noDataRow = document.getElementById('noDataUser');
        const summaryText = document.getElementById('summaryUser');
        const totalEntries = {{ count($semua_user) }};

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let foundCount = 0;
            let dataDitemukan = false;

            for (let i = 0; i < rows.length; i++) {
                // Lewati baris "Data tidak ditemukan"
                if (rows[i] === noDataRow) continue;

                // Cek teks di seluruh baris (Username, Role, Jabatan)
                const rowText = rows[i].textContent.toLowerCase();
                
                if (rowText.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    dataDitemukan = true;
                    foundCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Tampilkan/Sembunyikan pesan jika tidak ada data yang cocok
            noDataRow.style.display = dataDitemukan ? "none" : "";

            // Update info ringkasan data
            if (filter === "") {
                summaryText.innerText = `Showing 1 to ${totalEntries} of ${totalEntries} entries`;
            } else {
                summaryText.innerText = `Found ${foundCount} matching records`;
            }
        });
    });
</script>
@endsection