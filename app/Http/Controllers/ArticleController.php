<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('tag');

        // Filter tag
        if ($request->tag_id) {
            $query->where('tag_id', $request->tag_id);
        }

        // Urutan
        $sort = $request->sort == 'desc' ? 'desc' : 'asc';
        $query->orderBy('created_at', $sort);

        // Entries per page
        $perPage = in_array($request->per_page, [5, 10, 25, 50, 100]) ? $request->per_page : 10;

        $articles = $query->get();
        $tags = Tag::all();

        return view('admin.articles.index', [
            'articles' => $articles,
            'tags' => $tags,
            'pageTitle' => 'Daftar Artikel',
            'breadcrumb' => 'Daftar Artikel'
        ]);

    }


    public function create()
    {
        $tags = Tag::all();
        return view('admin.articles.create', [
            'tags' => $tags,
            'pageTitle' => 'Tambah Artikel',
            'breadcrumb' => 'Tambah Artikel'
        ]);

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tag_id' => 'required|exists:tags,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        Article::create($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit(Article $article)
    {
        $tags = Tag::all();
        return view('admin.articles.edit', [
            'tags' => $tags,
            'article' => $article,
            'pageTitle' => 'Edit Artikel',
            'breadcrumb' => 'Edit Artikel'
        ]);

    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'tag_id' => 'required|exists:tags,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($article->gambar) {
                Storage::disk('public')->delete($article->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $article->update($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy(Article $article)
    {
        if ($article->gambar) {
            Storage::disk('public')->delete($article->gambar);
        }
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus');
    }

    public function show(Article $article = null)
    {
        if (!$article) {
            // Jika tidak ada ID diberikan, ambil artikel terbaru
            $article = Article::latest()->first();
        }

        $latestPosts = Article::latest()
            ->where('id', '!=', $article->id)
            ->take(5)
            ->get();

        return view('admin.articles.show', [
            'article' => $article,
            'latestPosts' => $latestPosts,
            'pageTitle' => 'Detail Artikel',
            'breadcrumb' => 'Detail Artikel'
        ]);
    }

    public function generateArticleFromGemini(Request $request)
{
    $request->validate([
        'prompt' => 'required|string|max:1000',
    ]);

    try {
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json(['message' => 'API key tidak ditemukan.'], 500);
        }

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';

        $payload = [
            'contents' => [[
                'parts' => [[ 'text' => $request->prompt ]]
            ]]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("{$url}?key={$apiKey}", $payload);

        if ($response->failed()) {
            return response()->json(['message' => 'Gagal menghubungi layanan AI.'], 500);
        }

        $result = $response->json();

        if (isset($result['response']) && is_string($result['response'])) {
            $result = json_decode($result['response'], true);
        }

        $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$text) {
            return response()->json(['message' => 'AI tidak mengembalikan teks artikel.'], 500);
        }

        // Pisahkan baris-baris
        $text = str_replace("\\n", "\n", $text);
        $text = str_replace("\\", '', $text);
        $lines = preg_split('/\r\n|\r|\n/', $text);

        // Ambil Judul
        $judul = '';
        foreach ($lines as $line) {
            if (preg_match('/^#+\s*(.*)/', $line, $match)) {
                $judul = trim($match[1]);
                break;
            }
        }

        // Ambil deskripsi = paragraf pertama setelah judul
        $deskripsi = '';
        $isiParagraf = [];
        $skipJudul = true;

        foreach ($lines as $line) {
            $line = trim($line);
            if ($skipJudul && preg_match('/^#+\s*/', $line)) {
                $skipJudul = false;
                continue;
            }

            if (!$deskripsi && strlen($line) > 20) {
                $deskripsi = $line;
            } elseif (strlen($line) > 20) {
                $isiParagraf[] = $line;
            }
        }

        // Maksimal 5 paragraf isi
        $isi = implode("\n\n", array_slice($isiParagraf, 0, 5));

        return response()->json([
            'judul' => $judul ?: 'Artikel AI',
            'deskripsi' => $deskripsi ?: 'Deskripsi tidak ditemukan.',
            'isi' => $isi ?: 'Isi artikel tidak tersedia.',
        ]);

    } catch (\Exception $e) {
        Log::error('Gemini error: ' . $e->getMessage());
        return response()->json(['message' => 'Terjadi kesalahan server.'], 500);
    }
}

}
