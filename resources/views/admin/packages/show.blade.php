@extends('admin.layouts.main')

@section('content')
    <div class="row gy-4">
        <!-- KONTEN UTAMA -->
        <div class="col-lg-8">
            <div class="card p-0 radius-12 overflow-hidden">
                <div class="card-body p-0">
                    <img src="{{ asset('storage/' . $package->banner) }}" alt="Banner" class="w-100 h-100 object-fit-cover"
                        style="max-height: 400px;">
                    <div class="p-32">
                        <div class="d-flex align-items-center gap-16 justify-content-between flex-wrap mb-24">
                            <div class="d-flex align-items-center gap-8">
                                <div class="d-flex flex-column">
                                    <h5 class="fw-semibold">{{ $package->name }}</h5>
                                    <span class="text-sm text-neutral-500">
                                        {{ $package->location }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-md-3 gap-2 flex-wrap">
                                @php
                                    $prices = $package->options->pluck('price');
                                    $minPrice = $prices->min();
                                    $maxPrice = $prices->max();
                                @endphp

                                @if ($minPrice !== null && $maxPrice !== null)
                                    <div class="d-flex align-items-center gap-8 text-neutral-500 text-lg fw-medium">
                                        <iconify-icon icon="hugeicons:money-send-square" class="menu-icon"></iconify-icon>
                                        Rp{{ number_format($minPrice, 0, ',', '.') }}
                                        @if ($minPrice !== $maxPrice)
                                            - Rp{{ number_format($maxPrice, 0, ',', '.') }}
                                        @endif
                                    </div>
                                @endif
                                <div class="d-flex align-items-center gap-8 text-neutral-500 text-lg fw-medium">
                                    <i class="ri-calendar-2-line"></i>
                                    {{ $package->created_at->format('M d, Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-start mb-12">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $package->poster) }}" alt="Poster"
                                    class="max-width: 225px; max-height: 300px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <p class="text-neutral-600 text-md">{{ $package->description }}</p>
                            </div>
                        </div>

                        <h5 class="fw-semibold">Jenis Paket Trip</h5>
                        <div class="row">
                            @foreach ($package->options as $option)
                                <div class="col-md-6 mb-3">
                                    <div class="border p-3 rounded mb-1  h-100">
                                        <p><strong>Nama:</strong> {{ $option->option_name }}</p>
                                        <p><strong>Harga:</strong> Rp{{ number_format($option->price, 0, ',', '.') }}</p>
                                        <p><strong>Jenis Harga:</strong>
                                            {{ $option->price_type == 'per_orang' ? 'Per Orang' : 'Per Jeep' }}</p>
                                        <p><strong>Durasi:</strong> {{ $option->duration }}</p>
                                        <p><strong>Fasilitas:</strong></p>
                                        <ul class="list-unstyled ps-1">
                                            @foreach ($option->facilities as $facility)
                                                <li class="d-flex align-items-center gap-2 mb-1">
                                                    <iconify-icon icon="mdi:check-circle-outline"
                                                        class="text-success text-lg"></iconify-icon>
                                                    <span>{{ $facility->name }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <h5 class="fw-semibold mt-12">Lokasi Paket Trip</h5>
                        <div id="map" style="height: 250px;" class="rounded mb-12 mt-12"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="text-xl mb-0">Tentang Paket</h6>
                </div>
                <div class="card-body p-24">
                    <p><strong>Nama:</strong> {{ $package->name }}</p>
                    <p><strong>Lokasi:</strong> {{ $package->location }}</p>
                    <p><strong>Dibuat:</strong> {{ $package->created_at->format('d M Y') }}</p>
                    @php
                        $optionNames = $package->options->pluck('option_name')->unique()->toArray();
                    @endphp
                    <p class="mt-3 mb-1">
                        <strong>Jenis Paket:</strong> {{ implode(', ', $optionNames) }}
                    </p>
                    @php
                        $priceTypes = $package->options
                            ->pluck('price_type')
                            ->unique()
                            ->map(function ($type) {
                                return $type == 'per_orang' ? 'Per Orang' : 'Per Jeep';
                            })
                            ->toArray();
                    @endphp
                    <p class="mt-3">
                        <strong>Jenis Harga:</strong> {{ implode(', ', $priceTypes) }}
                    </p>
                    @php
                        $prices = $package->options->pluck('price');
                        $minPrice = $prices->min();
                        $maxPrice = $prices->max();
                    @endphp
                    <p class="mt-3 ">
                        <strong>Range Harga:</strong>
                        Rp{{ number_format($minPrice, 0, ',', '.') }}
                        @if ($minPrice !== $maxPrice)
                            – Rp{{ number_format($maxPrice, 0, ',', '.') }}
                        @endif
                    </p>
                </div>
            </div>
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h6 class="text-xl mb-0">Paket Terbaru</h6>
                </div>
                <div class="card-body d-flex flex-column gap-16 p-24">
                    @forelse($latestPackages as $latest)
                        <div class="d-flex gap-16 align-items-start pb-3 border-bottom">
                            <a href="{{ route('admin.packages.show', $latest->id) }}" class="mb-3"
                                style="width: 75px; height: 90px; object-fit: cover;">
                                <img src="{{ asset('storage/' . $latest->poster) }}" alt="{{ $latest->name }}"
                                    class="max-width: 75px; max-height: 90px; object-fit: cover;">
                            </a>
                            <div class="flex-grow-1">
                                <a href="{{ route('admin.packages.show', $latest->id) }}"
                                    class="text-line-2 text-hover-primary-600 text-md fw-semibold transition-2 mb-1 d-block">
                                    {{ Str::limit($latest->name, 50) }}
                                </a>
                                <span class="text-sm text-neutral-500 d-block">
                                    {{ $latest->created_at->format('d M Y') }}
                                </span>
                                @php
                                    $prices = $latest->options->pluck('price');
                                    $minPrice = $prices->min();
                                    $maxPrice = $prices->max();
                                @endphp
                                <span class="text-sm text-neutral-500 d-block">
                                    Rp{{ number_format($minPrice, 0, ',', '.') }}
                                    @if ($minPrice !== $maxPrice)
                                        – Rp{{ number_format($maxPrice, 0, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-neutral-500">Tidak ada paket lain.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
        <script>
            function initMap() {
                const location = {
                    lat: parseFloat({{ $package->latitude }}),
                    lng: parseFloat({{ $package->longitude }})
                };

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 13,
                    center: location
                });

                new google.maps.Marker({
                    position: location,
                    map: map
                });
            }

            document.addEventListener("DOMContentLoaded", function() {
                initMap();
            });
        </script>
    @endpush
@endsection
