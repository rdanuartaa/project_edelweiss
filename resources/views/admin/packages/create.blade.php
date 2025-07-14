@extends('admin.layouts.main')

@section('content')
    <div class="row gy-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="text-xl mb-0">{{ isset($package) ? 'Edit' : 'Tambah' }} Paket Trip</h6>
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
                        action="{{ isset($package) ? route('admin.packages.update', $package) : route('admin.packages.store') }}"
                        method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-20">
                        @csrf
                        @if (isset($package))
                            @method('PUT')
                        @endif

                        <div>
                            <h6 class="text-lg fw-semibold mb-8">Nama Paket Trip</h6>
                            <input type="text" name="name" class="form-control radius-8 "
                                placeholder="Contoh : Paket Trip Lava Tour Semeru"
                                value="{{ old('name', $package->name ?? '') }}" required>
                        </div>

                        <div>
                            <h6 class="text-lg fw-semibold mb-8">Lokasi</h6>
                            <input id="autocomplete" type="text" name="location" class="form-control radius-8"
                                value="{{ old('location', $package->location ?? '') }}" required
                                placeholder="Cari lokasi...">
                            <input type="hidden" id="latitude" name="latitude"
                                value="{{ old('latitude', $package->latitude ?? '') }}">
                            <input type="hidden" id="longitude" name="longitude"
                                value="{{ old('longitude', $package->longitude ?? '') }}">
                            <div id="map" style="height: 250px;" class="mt-3"></div>
                        </div>

                        <div>
                            <h6 class="text-lg fw-semibold mb-8">Deskripsi</h6>
                            <textarea name="description" class="form-control radius-8"
                                placeholder="Contoh : Lava Tour Semeru adalah pengalaman wisata seru menyusuri jalur lava dan bekas erupsi Gunung Semeru menggunakan jeep 4x4"
                                rows="5" required>{{ old('description', $package->description ?? '') }}</textarea>
                        </div>
                        <div class="row">
                            <!-- Upload Banner -->
                            <div class="col-md-6">
                                <div class="card h-100 p-0">
                                    <div class="card-header border-bottom bg-base py-16 px-24">
                                        <h6 class="text-lg fw-semibold mb-0">Upload Banner</h6>
                                    </div>
                                    <div class="card-body p-24">
                                        <label for="upload-banner"
                                            class="mb-2 border border-neutral-600 fw-medium text-secondary-light px-16 py-12 radius-12 d-inline-flex align-items-center gap-2 bg-hover-neutral-200">
                                            <iconify-icon icon="solar:upload-linear" class="text-xl"></iconify-icon>
                                            Klik untuk upload
                                            <input type="file" name="banner" id="upload-banner" class="form-control"
                                                hidden>
                                        </label>
                                        <small class="text-danger d-block mt-1">* Ukuran ideal banner: 1860 x 961
                                            piksel</small>

                                        <div class="mt-2">
                                            <img id="preview-banner"
                                                src="{{ isset($package->banner) ? asset('storage/' . $package->banner) : '' }}"
                                                style="width: 400px; height: 220px; object-fit: cover;"
                                                class="{{ isset($package->banner) ? '' : 'd-none' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Poster -->
                            <div class="col-md-6">
                                <div class="card h-100 p-0">
                                    <div class="card-header border-bottom bg-base py-16 px-24">
                                        <h6 class="text-lg fw-semibold mb-0">Upload Poster</h6>
                                    </div>
                                    <div class="card-body p-24">
                                        <label for="upload-poster"
                                            class="mb-2 border border-neutral-600 fw-medium text-secondary-light px-16 py-12 radius-12 d-inline-flex align-items-center gap-2 bg-hover-neutral-200">
                                            <iconify-icon icon="solar:upload-linear" class="text-xl"></iconify-icon>
                                            Klik untuk upload
                                            <input type="file" name="poster" id="upload-poster" class="form-control"
                                                hidden>
                                        </label>
                                        <small class="text-danger d-block mt-1">* Ukuran ideal poster: 1080 x 1440
                                            piksel</small>

                                        <div class="mt-2">
                                            <img id="preview-poster"
                                                src="{{ isset($package->poster) ? asset('storage/' . $package->poster) : '' }}"
                                                style="max-width: 225px; max-height: 300px; object-fit: cover;"
                                                class="{{ isset($package->poster) ? '' : 'd-none' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="text-lg fw-semibold mb-8">Opsi Jenis Paket</h6>
                            <div id="package-detail-container"></div>
                            <div class="d-flex gap-3 mt-2">
                                <button type="button" class="btn btn-outline-primary btn-sm" id="add-detail-button">
                                    + Tambah Jenis Paket
                                </button>
                                <button type="button" class="btn btn-outline-primary-600 btn-sm"
                                    id="duplicate-last-button">
                                    ⧉ Duplikat Jenis Terakhir
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn {{ isset($package) ? 'btn-warning' : 'btn-success' }} radius-8">
                            {{ isset($package) ? 'Update' : 'Simpan' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="fw-semibold mt-3">Tips Isi Form Utama:</h6>
                </div>
                <div class="card-body p-24 d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-success text-lg"></iconify-icon>
                        <span>Gunakan Nama Paket yang Menarik</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-success text-lg"></iconify-icon>
                        <span>Pastikan Lokasi Sesuai Google Maps</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-success text-lg"></iconify-icon>
                        <span>Deskripsi Harus Jelas Menarik Perhatian Tamu</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-success text-lg"></iconify-icon>
                        <span>Upload Gambar Sesuai Ukuran Ideal</span>
                    </div>
                    <hr>
                    <h6 class="fw-semibold mt-3">Tips Isi Opsi Jenis Paket:</h6>
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-success text-lg"></iconify-icon>
                        <span>Gunakan nama yang membedakan setiap jenis (misalnya: Paket A, Paket B, dll).</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-success text-lg"></iconify-icon>
                        <span>Isi harga sesuai jenis, dan tentukan apakah per orang atau per jeep.</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-success text-lg"></iconify-icon>
                        <span>Durasi harus jelas, misalnya "2 Hari 1 Malam" atau "4 Jam".</span>
                    </div>

                    {{-- Tambahan Tips Fasilitas --}}
                    <hr>
                    <h6 class="fw-semibold mt-3">Tips Isi Form Fasilitas:</h6>
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-success text-lg"></iconify-icon>
                        <span>Tambahkan fasilitas utama seperti makan, transportasi, guide, dll.</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-success text-lg"></iconify-icon>
                        <span>Jangan menambahkan fasilitas yang tidak tersedia dalam paket tersebut.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $optionData = [];

        if (isset($package) && $package->options) {
            foreach ($package->options as $option) {
                $optionData[] = [
                    'data' => [
                        'option_name' => $option->option_name,
                        'price' => $option->price,
                        'duration' => $option->duration,
                        'price_type' => $option->price_type,
                    ],
                    'facilities' => $option->facilities->pluck('name')->toArray(),
                ];
            }
        }
    @endphp
    @push('script')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>

        <script>
            const packageOptions = @json($optionData);
            let optionIndex = 0;
            let map;
            let marker;
            const container = $('#package-detail-container');

            function initMap() {
                const initialPosition = {
                    lat: parseFloat(document.getElementById('latitude').value) || -7.250445,
                    lng: parseFloat(document.getElementById('longitude').value) || 112.768845
                };

                map = new google.maps.Map(document.getElementById("map"), {
                    center: initialPosition,
                    zoom: 13
                });

                marker = new google.maps.Marker({
                    position: initialPosition,
                    map,
                    draggable: true
                });

                marker.addListener("dragend", function(e) {
                    updateCoordinates(e.latLng);
                });

                map.addListener("click", function(e) {
                    marker.setPosition(e.latLng);
                    updateCoordinates(e.latLng);
                });

                const input = document.getElementById("autocomplete");
                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo("bounds", map);

                autocomplete.addListener("place_changed", function() {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) return;

                    map.setCenter(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                    updateCoordinates(place.geometry.location);
                });
            }

            function updateCoordinates(latlng) {
                document.getElementById("latitude").value = latlng.lat();
                document.getElementById("longitude").value = latlng.lng();
            }

            function createFacilityInput(optionIndex, value = '') {
                return `
            <div class="input-group mb-3 facility-item">
                <input type="text" name="options[${optionIndex}][facilities][]" class="form-control" placeholder="Contoh : Include Sarapan" value="${value}">
                <button class="btn btn-outline-danger btn-sm remove-facility-button" type="button">
                    <iconify-icon icon="mdi:close"></iconify-icon>
                </button>
            </div>
        `;
            }

            function createOptionBlock(index, data = {}) {
                const block = $(`
            <div class="border p-3 rounded mb-3" data-option-index="${index}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Jenis</label>
                        <input type="text" name="options[${index}][option_name]" class="form-control" placeholder="Contoh : Paket A" value="${data.option_name || ''}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="options[${index}][price]" class="form-control" placeholder="Masukkan Nominal Saja Contoh : 20000" value="${data.price || ''}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Harga</label>
                        <select name="options[${index}][price_type]" class="form-control" required>
                            <option value="per_orang" ${data.price_type === 'per_orang' ? 'selected' : ''}>Per Orang</option>
                            <option value="per_jeep" ${data.price_type === 'per_jeep' ? 'selected' : ''}>Per Jeep</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Durasi</label>
                        <input type="text" name="options[${index}][duration]" class="form-control" placeholder="Contoh : 2 Jam atau 2 Hari 3 Malam" value="${data.duration || ''}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label mb-2">Fasilitas</label>
                    <div class="facility-wrapper mb-3"></div>
                    <button type="button" class="btn btn-outline-secondary btn-sm add-facility-button">+ Tambah Fasilitas</button>
                </div>

                <button type="button" class="btn btn-sm btn-danger remove-option-button">Hapus Opsi Paket</button>
            </div>
        `);

                block.find('.add-facility-button').on('click', function() {
                    const wrapper = $(this).siblings('.facility-wrapper');
                    wrapper.append(createFacilityInput(index));
                });

                block.find('.remove-option-button').on('click', function() {
                    block.remove();
                });

                block.on('click', '.remove-facility-button', function() {
                    $(this).closest('.facility-item').remove();
                });

                return block;
            }

            function addOption(data = {}, facilities = []) {
                const block = createOptionBlock(optionIndex, data);
                container.append(block);

                facilities.forEach(facility => {
                    block.find('.facility-wrapper').append(createFacilityInput(optionIndex, facility));
                });

                optionIndex++;
            }

            function duplicateLastOption() {
                const lastOption = container.children().last();
                if (!lastOption.length) return;

                const index = optionIndex;

                const data = {
                    option_name: lastOption.find('input[name$="[option_name]"]').val(),
                    price: lastOption.find('input[name$="[price]"]').val(),
                    price_type: lastOption.find('select[name$="[price_type]"]').val(),
                    duration: lastOption.find('input[name$="[duration]"]').val(),
                };

                const facilities = [];
                lastOption.find('.facility-wrapper input').each(function() {
                    facilities.push($(this).val());
                });

                const block = createOptionBlock(index, data);
                container.append(block);

                facilities.forEach(facility => {
                    block.find('.facility-wrapper').append(createFacilityInput(index, facility));
                });

                optionIndex++;
            }

            $(document).ready(function() {
                initMap();

                if (packageOptions.length > 0) {
                    packageOptions.forEach(opt => {
                        addOption(opt.data, opt.facilities);
                    });
                } else {
                    addOption();
                }

                $('#add-detail-button').on('click', function() {
                    addOption();
                });

                $('#duplicate-last-button').on('click', function() {
                    duplicateLastOption();
                });
            });

            document.getElementById("upload-banner").addEventListener("change", function(e) {
                const input = e.target;
                const preview = document.getElementById("preview-banner");

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            document.getElementById("upload-poster").addEventListener("change", function(e) {
                const input = e.target;
                const preview = document.getElementById("preview-poster");

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        </script>
    @endpush
@endsection
