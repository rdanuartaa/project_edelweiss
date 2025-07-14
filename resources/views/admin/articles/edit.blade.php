@extends('admin.layouts.main')

@section('content')
    <div class="row gy-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="text-xl mb-0">{{ isset($article) ? 'Edit' : 'Tambah' }} Artikel</h6>
                </div>
                <div class="card-body p-24">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form
                        action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
                        method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-20">
                        @csrf
                        @if (isset($article))
                            @method('PUT')
                        @endif

                        <div>
                            <label class="form-label fw-bold text-neutral-900">Judul Artikel</label>
                            <input type="text" name="judul" id="judul"
                                class="form-control border border-neutral-200 radius-8" placeholder="Masukkan judul artikel"
                                value="{{ old('judul', $article->judul ?? '') }}" required>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-neutral-900">Tag</label>
                            <select name="tag_id" class="form-select border border-neutral-200 radius-8" required>
                                <option value="">Pilih Tag</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ old('tag_id', $article->tag_id ?? '') == $tag->id ? 'selected' : '' }}>
                                        {{ $tag->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-neutral-900">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control border border-neutral-200 radius-8"
                                placeholder="Opsional...">{{ old('deskripsi', $article->deskripsi ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-neutral-900">Isi Artikel</label>
                            <textarea name="isi" id="isi" class="form-control border border-neutral-200 radius-8" rows="6"
                                placeholder="Masukkan isi artikel" required>{{ old('isi', $article->isi ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-neutral-900">Upload Thumbnail</label>
                            <div class="upload-image-wrapper">
                                <div
                                    class="uploaded-img {{ isset($article->gambar) ? '' : 'd-none' }} position-relative h-250-px w-100 border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                    <button type="button"
                                        class="uploaded-img__remove position-absolute top-0 end-0 z-1 me-8 mt-8 d-flex bg-danger-600 w-40-px h-40-px justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="radix-icons:cross-2" class="text-2xl text-white"></iconify-icon>
                                    </button>
                                    <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover"
                                        src="{{ isset($article->gambar) ? asset('storage/' . $article->gambar) : '' }}"
                                        alt="Preview Gambar">
                                </div>
                                <label
                                    class="upload-file h-250-px w-100 border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                                    for="upload-file">
                                    <iconify-icon icon="solar:camera-outline"
                                        class="text-xl text-secondary-light"></iconify-icon>
                                    <span class="fw-semibold text-secondary-light">Upload</span>
                                    <input id="upload-file" type="file" name="gambar" hidden>
                                </label>
                            </div>
                        </div>

                        <button type="submit"
                            class="btn {{ isset($article) ? 'btn-primary-600' : 'btn-success' }} radius-8">
                            {{ isset($article) ? 'Update' : 'Simpan' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Generator AI -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="text-xl mb-0">Buat Artikel Otomatis</h6>
                </div>
                <div class="card-body p-24">
                    <label class="form-label fw-bold text-neutral-900">Prompt AI</label>
                    <textarea class="form-control mb-3" id="prompt-input" rows="3"
                        placeholder="Contoh: Buatkan artikel tentang Pronojiwo terkini..."></textarea>
                    <button type="button" class="btn btn-primary w-100" id="btn-buat-artikel-ai">Buatkan Artikel</button>
                </div>
            </div>
        </div>
    </div>
<script>window.route_generate_ai = "{{ route('admin.articles.gemini.generate') }}";</script>
    @push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById("upload-file");
    const imagePreview = document.getElementById("uploaded-img__preview");
    const uploadedImgContainer = document.querySelector(".uploaded-img");
    const removeButton = document.querySelector(".uploaded-img__remove");

    if (fileInput && imagePreview && uploadedImgContainer && removeButton) {
        fileInput.addEventListener("change", (e) => {
            if (e.target.files.length) {
                const src = URL.createObjectURL(e.target.files[0]);
                imagePreview.src = src;
                uploadedImgContainer.classList.remove('d-none');
            }
        });

        removeButton.addEventListener("click", () => {
            imagePreview.src = "";
            uploadedImgContainer.classList.add('d-none');
            fileInput.value = "";
        });
    }

    document.getElementById('btn-buat-artikel-ai')
        .addEventListener('click', async function () {
            const prompt = document.getElementById('prompt-input').value.trim();
            if (!prompt) return alert('Isi prompt dulu!');

            this.disabled = true;
            this.innerText = 'Memuat...';

            try {
                const res = await fetch(window.route_generate_ai, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({ prompt })
                });

                const data = await res.json();

                if (!data.artikel) {
                    alert('AI tidak mengembalikan isi artikel.');
                    return;
                }

                const lines = data.artikel.split('\n');
                const title = lines.find(l => l.startsWith('##'))?.replace(/^#+/, '').trim() || '';
                const desc = data.artikel.split('\n\n')[1] || '';

                document.getElementById('judul').value = title;
                document.getElementById('deskripsi').value = desc;
                document.getElementById('isi').value = data.artikel;

            } catch (e) {
                console.error('Fetch error:', e);
                alert('Gagal: ' + e.message);
            } finally {
                this.disabled = false;
                this.innerText = 'Buatkan Artikel';
            }
        });
});
</script>
@endpush
@endsection
