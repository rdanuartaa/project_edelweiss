@extends('admin.layouts.main')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<div class="card basic-data-table">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Pengguna</h5>
    </div>
    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table bordered-table mb-0" id="userTable">
            <thead>
                <tr>
                    <th class="text-start">No</th>
                    <th class="text-start">Tanggal Registrasi</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="text-start">{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="fw-medium">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge text-sm fw-semibold text-success-600 bg-success-100 px-20 py-9 radius-4 text-white {{ $user->role == 'admin' ? 'badge text-sm fw-semibold text-info-600 bg-info-100 px-20 py-9 radius-4 text-white' : 'bg-secondary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="d-flex gap-2">
                            <!-- Tombol Ubah Role -->
                            <button class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center"
                                title="Ubah Role" data-bs-toggle="modal" data-bs-target="#roleModal-{{ $user->id }}">
                                <iconify-icon icon="mdi:account-cog-outline"></iconify-icon>
                            </button>

                            <!-- Tombol Hapus -->
                            <button class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteUserModal-{{ $user->id }}">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL: Role & Hapus -->
@foreach ($users as $user)
    <!-- Modal Ubah Role -->
    <div class="modal fade" id="roleModal-{{ $user->id }}" tabindex="-1" aria-labelledby="roleModalLabel-{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border-bottom">
                    <h5 class="modal-title" id="roleModalLabel-{{ $user->id }}">Ubah Role: {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold text-neutral-900">Pilih Role</label>
                            <select name="role" class="form-select border border-neutral-200 radius-8" required>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteUserModal-{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel-{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border-bottom">
                    <h5 class="modal-title" id="deleteUserModalLabel-{{ $user->id }}">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-24">
                    <p>Apakah kamu yakin ingin menghapus pengguna <strong>{{ $user->name }}</strong>?</p>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new DataTable('#userTable');
    });
</script>
@endpush
@endsection
