@extends('admin.layouts.main')

@section('content')
<div class="card basic-data-table">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Artikel</h5>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary-600">+ Tambah Artikel</a>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0" id="dataTable">
            <thead>
                <tr>
                    <th class="text-start">No</th>
                    <th class="text-start">Tanggal Dibuat</th>
                    <th>Judul</th>
                    <th>Tag</th>
                    <th class="text-start">Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $index => $article)
                    <tr>
                        <td class="text-start">{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $article->created_at->format('d M Y') }}</td>
                        <td class="fw-medium">{{ $article->judul }}</td>
                        <td>
                            <span class="badge text-sm fw-semibold text-success-600 bg-info-100 px-20 py-9 radius-4 text-white">
                                {{ $article->tag->nama }}
                            </span>
                        </td>
                        <td>
                            @if ($article->gambar)
                                <img src="{{ asset('storage/' . $article->gambar) }}" alt="Gambar"
                                    style="width: 90px; height: 60px;" class="rounded d-block">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.articles.show', $article->id) }}"
                                class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center"
                                title="Lihat">
                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                            </a>
                            <a href="{{ route('admin.articles.edit', $article->id) }}"
                                class="w-32-px h-32-px bg-warning-focus text-warning-700 rounded-circle d-inline-flex align-items-center justify-content-center"
                                title="Edit">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteArticleModal-{{ $article->id }}"
                                class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                title="Hapus">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
@foreach ($articles as $article)
<div class="modal fade" id="deleteArticleModal-{{ $article->id }}" tabindex="-1"
    aria-labelledby="deleteArticleModalLabel-{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border-bottom">
                <h5 class="modal-title" id="deleteArticleModalLabel-{{ $article->id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-24">
                <p>Apakah kamu yakin ingin menghapus artikel <strong>{{ $article->judul }}</strong>?</p>
                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST">
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
</script>
@endpush
@endsection
