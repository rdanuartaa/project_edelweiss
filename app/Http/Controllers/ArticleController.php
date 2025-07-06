<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Abort;
use App\Models\Article;
use App\Models\Tag;

class ArticleController extends Controller
{
    // Tampilkan semua artikel
    public function index()
    {
        $articles = Article::with('tags')->get();
        return view('admin.artikel.index', compact('articles'));
    }

    // Form tambah artikel
    public function create()
    {
        $tags = Tag::all();
        return view('admin.artikel.create', compact('tags'));
    }

    // Simpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'isi' => 'required',
        ]);

        $article = Article::create($request->only(['judul', 'deskripsi', 'isi', 'gambar']));

        if ($request->has('tags')) {
            $article->tags()->attach($request->tags);
        }

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dibuat.');
    }

    // Detail artikel
    public function show($id)
    {
        $article = Article::with('tags')->find($id);

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan');
        }

        return view('admin.artikel.show', compact('article'));
    }

    // Form edit artikel
    public function edit($id)
    {
        $article = Article::with('tags')->find($id);

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan');
        }

        $tags = Tag::all();
        return view('admin.artikel.edit', compact('article', 'tags'));
    }

    // Update artikel
    public function update(Request $request, $id)
    {
        $article = Article::with('tags')->find($id);

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan');
        }

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'isi' => 'required',
        ]);

        $article->update($request->only(['judul', 'deskripsi', 'isi', 'gambar']));

        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        } else {
            $article->tags()->detach();
        }

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate.');
    }

    // Hapus artikel
    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan');
        }

        $article->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
