@extends('admin.layouts.main')
@section('content')
    <div class="row gy-4">
        <div class="col-lg-8">
            <div class="card p-0 radius-12 overflow-hidden">
                <div class="card-body p-0">
                    <img src="{{ asset('storage/' . $article->gambar) }}" alt="Gambar Artikel"
                        class="w-100 h-100 object-fit-cover">
                    <div class="p-32">
                        <div class="d-flex align-items-center gap-16 justify-content-between flex-wrap mb-24">
                            <div class="d-flex align-items-center gap-8">
                                <img src="{{ asset('admin_assets/images/user.png') }}" alt="Admin"
                                    class="w-48-px h-48-px rounded-circle object-fit-cover">
                                <div class="d-flex flex-column">
                                    <h6 class="text-lg mb-0">Edelweiss Tour & Travel</h6>
                                    <span
                                        class="text-sm text-neutral-500">{{ $article->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-md-3 gap-2 flex-wrap">
                                <div class="d-flex align-items-center gap-8 text-neutral-500 text-lg fw-medium">
                                    <i class="ri-price-tag-3-line"></i>
                                    {{ $article->tag->nama }}
                                </div>
                                <div class="d-flex align-items-center gap-8 text-neutral-500 text-lg fw-medium">
                                    <i class="ri-calendar-2-line"></i>
                                    {{ $article->created_at->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                        <h3 class="mb-16">{{ $article->judul }}</h3>
                        @if ($article->deskripsi)
                            <p class="text-neutral-500 mb-16">{{ $article->deskripsi }}</p>
                        @endif
                        <p class="text-neutral-600 text-md my-16">{!! nl2br(e($article->isi)) !!}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Start -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="text-xl mb-0">Tentang Artikel</h6>
                </div>
                <div class="card-body p-24">
                    <p><strong>Judul:</strong> {{ $article->judul }}</p>
                    <p><strong>Tag:</strong> {{ $article->tag->nama }}</p>
                    <p><strong>Tanggal Dibuat:</strong> {{ $article->created_at->format('d M Y') }}</p>
                    @if ($article->deskripsi)
                        <p><strong>Deskripsi:</strong> {{ $article->deskripsi }}</p>
                    @endif
                </div>
            </div>
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h6 class="text-xl mb-0">Latest Posts</h6>
                </div>
                <div class="card-body d-flex flex-column gap-16 p-24">
                    @forelse($latestPosts as $post)
                        <div class="d-flex gap-16 align-items-start">
                            {{-- Gambar artikel --}}
                            <a href="{{ route('admin.articles.show', $post->id) }}" class="flex-shrink-0"
                                style="width: 80px; height: 80px; overflow: hidden; border-radius: 8px;">
                                <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}"
                                    class="w-100 h-100 object-fit-cover">
                            </a>
                            {{-- Judul dan tanggal --}}
                            <div class="flex-grow-1">
                                <a href="{{ route('admin.articles.show', $post->id) }}"
                                    class="text-line-2 text-hover-primary-600 text-md fw-semibold transition-2 mb-1 d-block">
                                    {{ Str::limit($post->judul, 50) }}
                                </a>
                                <span class="text-sm text-neutral-500">
                                    {{ $post->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-neutral-500">Tidak ada artikel lain.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
