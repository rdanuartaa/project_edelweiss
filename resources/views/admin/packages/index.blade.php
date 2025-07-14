    @extends('admin.layouts.main')

    @section('content')
        <div class="card basic-data-table">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Paket Trip</h5>
                <a href="{{ route('admin.packages.create') }}" class="btn btn-primary-600">+ Tambah Paket</a>
            </div>

            <div class="card-body">
                <table class="table bordered-table mb-0" id="packageTable">
                    <thead>
                        <tr>
                            <th class="text-start">No</th>
                            <th>Tanggal Dibuat</th>
                            <th>Nama</th>
                            <th>Jenis Paket</th>
                            <th>Jenis Harga</th>
                            <th>Harga</th>
                            <th class="text-start">Poster</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $index => $package)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($package->created_at)->translatedFormat('d F Y') }}</td>
                                <td class="fw-medium">{{ $package->name }}</td>
                                <td>
                                    @php
                                        $jenisPaket = $package->options->pluck('option_name')->implode(', ');
                                    @endphp
                                    {{ $jenisPaket }}
                                </td>
                                <td>
                                    @php
                                        $jenisHarga = $package->options
                                            ->pluck('price_type')
                                            ->unique()
                                            ->map(function ($type) {
                                                return ucwords(str_replace('_', ' ', $type));
                                            })
                                            ->implode(', ');
                                    @endphp
                                    {{ $jenisHarga ?: '-' }}
                                </td>
                                @php
                                    $prices = $package->options->pluck('price');
                                    $minPrice = $prices->min();
                                    $maxPrice = $prices->max();
                                @endphp
                                <td>
                                    @if ($minPrice === $maxPrice)
                                        Rp{{ number_format($minPrice, 0, ',', '.') }}
                                    @else
                                        Rp{{ number_format($minPrice, 0, ',', '.') }} -
                                        Rp{{ number_format($maxPrice, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($package->poster)
                                        <img src="{{ asset('storage/' . $package->poster) }}" alt="Poster"
                                            style="width: 70px; height: 100px;" class="d-block mx-0 my-auto">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Show -->
                                    <a href="{{ route('admin.packages.show', $package->id) }}"
                                        class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        title="Lihat Detail">
                                        <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                    </a>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.packages.edit', $package->id) }}"
                                        class="w-32-px h-32-px bg-warning-focus text-warning-700 rounded-circle d-inline-flex align-items-center justify-content-center"
                                        title="Edit">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <a href="javascript:void(0)"
                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                        title="Hapus" data-bs-toggle="modal"
                                        data-bs-target="#deletePackageModal-{{ $package->id }}">
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
        @foreach ($packages as $package)
            <div class="modal fade" id="deletePackageModal-{{ $package->id }}" tabindex="-1"
                aria-labelledby="deletePackageModalLabel-{{ $package->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content radius-16 bg-base">
                        <div class="modal-header py-16 px-24 border-bottom">
                            <h5 class="modal-title" id="deletePackageModalLabel-{{ $package->id }}">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body p-24">
                            <p>Apakah kamu yakin ingin menghapus paket <strong>{{ $package->name }}</strong>?</p>
                            <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Batal</button>
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
                document.addEventListener("DOMContentLoaded", function() {
                    new DataTable('#packageTable');
                });
            </script>
        @endpush
    @endsection
