<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        // Ambil semua tag dengan jumlah artikel yang terkait
        $tags = Tag::withCount('articles')->get();

        return view('admin.tags.index', [
            'tags' => $tags,
            'pageTitle' => 'Daftar Tag',
            'breadcrumb' => 'Daftar Tag'
        ]);
    }


    public function create() {
        return view('admin.tags.create');
    }

    public function store(Request $request) {
        $request->validate(['nama' => 'required']);
        Tag::create($request->all());
        return redirect()->route('admin.tags.index')->with('success', 'Tag berhasil dibuat');
    }

    public function edit(Tag $tag) {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag) {
        $request->validate(['nama' => 'required']);
        $tag->update($request->all());
        return redirect()->route('admin.tags.index')->with('success', 'Tag berhasil diupdate');
    }

    public function destroy(Tag $tag) {
        $tag->delete();
        return back()->with('success', 'Tag berhasil dihapus');
    }

}
