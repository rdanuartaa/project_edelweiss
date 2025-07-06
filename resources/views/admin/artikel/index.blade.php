@extends('admin.layouts.main')
@section('content')
<div class="container">
    <h2>Daftar Artikel</h2>
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-success mb-3">Tambah Artikel</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tags</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->judul }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($article->deskripsi, 50) }}</td>
                    <td>
                        @foreach($article->tags as $tag)
                            <span class="badge bg-secondary">{{ $tag->nama }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.artikel.show', $article->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('admin.artikel.edit', $article->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.artikel.destroy', $article->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
