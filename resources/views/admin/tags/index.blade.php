@extends('admin.layouts.main')

@section('content')
<div class="row gy-4">
    <!-- KIRI: Tabel Daftar Tag -->
    <div class="col-lg-8">
        <div class="card basic-data-table">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Tag</h5>
                <button class="btn btn-primary-600" data-bs-toggle="modal" data-bs-target="#createTagModal">+ Tambah Tag</button>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table bordered-table mb-0" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-start">No</th>
                            <th>Tanggal Dibuat</th>
                            <th>Nama Tag</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $index => $tag)
                            <tr>
                                <td class="text-start">{{ $loop->iteration }}</td>
                                <td>{{ $tag->created_at->format('d M Y') }}</td>
                                <td class="fw-medium text-dark">{{ $tag->nama }}</td>
                                <td class="d-flex gap-2">
                                    <!-- Tombol Edit -->
                                    <button class="w-32-px h-32-px bg-warning-focus text-warning-700 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        title="Edit" data-bs-toggle="modal" data-bs-target="#editTagModal-{{ $tag->id }}">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <button class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                        title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteTagModal-{{ $tag->id }}">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- KANAN: Statistik Artikel per Tag -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h6 class="text-xl mb-0">Statistik Penggunaan Tag</h6>
            </div>
            <div class="card-body p-24">
                @if ($tags->count() > 0)
                    <ul class="list-unstyled mb-0">
                        @foreach ($tags as $tag)
                            <li class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8 border-bottom border-dashed pb-12 mb-12">
                                <span class="text-dark fw-semibold">{{ $tag->nama }}</span>
                                <span class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center text-xs fw-semibold">
                                    {{ $tag->articles_count ?? 0 }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada tag yang digunakan dalam artikel.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Tag -->
<div class="modal fade" id="createTagModal" tabindex="-1" aria-labelledby="createTagModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border-bottom">
                <h5 class="modal-title" id="createTagModalLabel">Tambah Tag Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-24">
                <form action="{{ route('admin.tags.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-neutral-900">Nama Tag</label>
                        <input type="text" name="nama" class="form-control border border-neutral-200 radius-8"
                            placeholder="Masukkan nama tag" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit dan Hapus (per Tag) -->
@foreach ($tags as $tag)
    <!-- Modal Edit -->
    <div class="modal fade" id="editTagModal-{{ $tag->id }}" tabindex="-1" aria-labelledby="editTagModalLabel-{{ $tag->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border-bottom">
                    <h5 class="modal-title" id="editTagModalLabel-{{ $tag->id }}">Edit Tag: {{ $tag->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold text-neutral-900">Nama Tag</label>
                            <input type="text" name="nama" class="form-control border border-neutral-200 radius-8"
                                value="{{ $tag->nama }}" required>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteTagModal-{{ $tag->id }}" tabindex="-1" aria-labelledby="deleteTagModalLabel-{{ $tag->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border-bottom">
                    <h5 class="modal-title" id="deleteTagModalLabel-{{ $tag->id }}">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-24">
                    <p>Apakah kamu yakin ingin menghapus tag <strong>{{ $tag->nama }}</strong>?</p>
                    <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST">
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
        new DataTable('#dataTable');
    });
    $(document).ready(function() {
                $(document).on('click', '.remove-item-btn', function() {
                    $(this).closest('tr').addClass('d-none');
                });
            });
</script>
@endpush
@endsection
