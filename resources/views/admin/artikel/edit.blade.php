@extends('admin.layouts.main')
@section('content')
<div class="container">
    <h2>Edit Artikel</h2>

    <form action="{{ route('admin.artikel.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $article->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" required>{{ old('deskripsi', $article->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi Artikel</label>
            <textarea name="isi" id="isi" rows="5" class="form-control" required>{{ old('isi', $article->isi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (URL)</label>
            <input type="text" name="gambar" id="gambar" class="form-control" value="{{ old('gambar', $article->gambar) }}">
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <select name="tags[]" id="tags" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $article->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $tag->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
