@extends('admin.layouts.main')

@section('content')
    <div class="row gy-4">
        <div class="col-12">
            <div class="card basic-data-table">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Jadwal Paket per Bulan</h5>
                    <button class="btn btn-primary-600" data-bs-toggle="modal" data-bs-target="#generateModal">
                        + Generate Kuota Bulanan
                    </button>
                </div>
                <div class="card-body">
                    <table class="table bordered-table mb-0" id="scheduleTable">
                        <thead>
                            <tr>
                                <th class="text-start">No</th>
                                <th>Nama Paket</th>
                                <th>Bulan</th>
                                <th class="text-start">Total Kuota</th>
                                <th class="text-start">Sisa Kuota</th>
                                <th class="text-start">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scheduleGroups as $index => $group)
                                <tr>
                                    <td class="text-start">{{ $loop->iteration }}</td>
                                    <td>{{ $group->package->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($group->month . '-01')->translatedFormat('F Y') }}</td>
                                    <td class="text-start">{{ $group->total_quota }}</td>
                                    <td class="text-start">{{ $group->total_remaining_quota }}</td>
                                    <td class="text-center d-flex gap-2">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('admin.package_schedules.show', ['package_id' => $group->package_id, 'month' => $group->month]) }}"
                                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center"
                                            title="Lihat Detail">
                                            <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                        </a>

                                        <!-- Tombol Hapus Modal -->
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-{{ $group->package_id }}-{{ $group->month }}"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                            title="Hapus">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Hapus -->
                                <!-- Modal Hapus (Versi Baru) -->
                                <div class="modal fade" id="deleteModal-{{ $group->package_id }}-{{ $group->month }}"
                                    tabindex="-1"
                                    aria-labelledby="deleteModalLabel-{{ $group->package_id }}-{{ $group->month }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content radius-16 bg-base">
                                            <div class="modal-header py-16 px-24 border-bottom">
                                                <h5 class="modal-title"
                                                    id="deleteModalLabel-{{ $group->package_id }}-{{ $group->month }}">
                                                    Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body p-24">
                                                <p>Apakah kamu yakin ingin menghapus seluruh kuota untuk paket
                                                    <strong>{{ $group->package->name }}</strong>
                                                    bulan
                                                    <strong>{{ \Carbon\Carbon::parse($group->month . '-01')->translatedFormat('F Y') }}</strong>?
                                                </p>
                                                <form
                                                    action="{{ route('admin.package_schedules.destroyMonth', ['package_id' => $group->package_id, 'month' => $group->month]) }}"
                                                    method="POST">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="generateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border-bottom">
                    <h5 class="modal-title" id="generateModalLabel">Generate Kuota Bulanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('admin.package_schedules.generate') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="package_id" class="form-label fw-bold text-neutral-900">Pilih Paket</label>
                            <select name="package_id" id="package_id" class="form-select select-custom border border-neutral-200 radius-8"
                                required>
                                <option value="">-- Pilih Paket --</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="month" class="form-label fw-bold text-neutral-900">Bulan</label>
                            <input type="month" name="month" id="month"
                                class="form-control border border-neutral-200 radius-8" required>
                        </div>
                        <div class="mb-3">
                            <label for="quota" class="form-label fw-bold text-neutral-900">Kuota per Hari</label>
                            <input type="number" name="quota" id="quota"
                                class="form-control border border-neutral-200 radius-8" required min="1">
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Generate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            new DataTable('#scheduleTable');
        </script>
    @endpush
@endsection
