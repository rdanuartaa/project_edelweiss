@extends('admin.layouts.main')

@section('content')
    <div class="row gy-4">
        <div class="col-12">
            <div class="card basic-data-table">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        Detail Jadwal {{ $package->name }} -
                        {{ \Carbon\Carbon::parse($month . '-01')->translatedFormat('F Y') }}
                    </h5>
                    <a href="{{ route('admin.package_schedules.index') }}"
                        class="btn btn-light-100 text-dark btn-sm d-inline-flex align-items-center gap-1">
                        <iconify-icon icon="mdi-keyboard-backspace" class="menu-icon"></iconify-icon>
                        <span>Kembali</span>
                    </a>
                </div>

                <!-- Tabs untuk Jenis Paket -->
                <ul class="nav nav-tabs px-3 pt-3" id="jenisTabs" role="tablist">
                    @foreach ($groupedByJenis as $jenis => $dataJenis)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ Str::slug($jenis) }}"
                                data-bs-toggle="tab" data-bs-target="#jenis-{{ Str::slug($jenis) }}" type="button"
                                role="tab">
                                {{ $jenis }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="card-body">
                    <div class="tab-content" id="jenisTabsContent">
                        @foreach ($groupedByJenis as $jenis => $dataJenis)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="jenis-{{ Str::slug($jenis) }}" role="tabpanel">
                                <table class="table bordered-table w-100 datatable-jenis mb-0"
                                    id="datatable-jenis-{{ Str::slug($jenis) }}">
                                    <thead>
                                        <tr>
                                            <th class="text-start">Tanggal</th>
                                            <th>Jenis Harga</th>
                                            <th>Harga</th>
                                            <th class="text-start">Kuota</th>
                                            <th class="text-start">Sisa Kuota</th>
                                            <th class="text-start">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataJenis as $i => $schedule)
                                            <tr>
                                                <td class="text-start">{{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('d F Y') }}
                                                </td>
                                                <td>{{ ucwords(str_replace('_', ' ', $schedule->packageDetail->price_type ?? '-')) }}
                                                </td>
                                                <td>Rp
                                                    {{ number_format($schedule->packageDetail->price ?? 0, 0, ',', '.') }}
                                                </td>
                                                <td class="text-start">{{ $schedule->quota }}</td>
                                                <td class="text-start">{{ $schedule->remaining_quota }}</td>
                                                <td class="item-start d-flex gap-2 ">
                                                    <!-- Tombol Edit -->
                                                    <a href="javascript:void(0)"
                                                        class="w-32-px h-32-px bg-warning-focus text-warning-700 rounded-circle d-inline-flex align-items-center justify-content-center"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal-{{ $schedule->id }}" title="Edit">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                    <!-- Tombol Hapus -->
                                                    <a href="javascript:void(0)"
                                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-{{ $schedule->id }}" title="Hapus">
                                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal-{{ $schedule->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel-{{ $schedule->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content radius-16 bg-base">
                                                        <div class="modal-header py-16 px-24 border-bottom">
                                                            <h5 class="modal-title">Edit Kuota Harian</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body p-24">
                                                            <form
                                                                action="{{ route('admin.package_schedules.updateQuota', $schedule->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Tanggal</label>
                                                                        <input type="text" class="form-control" readonly
                                                                            value="{{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('d F Y') }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Jenis Paket</label>
                                                                        <input type="text" class="form-control" readonly
                                                                            value="{{ $schedule->packageDetail->option_name ?? '-' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Jenis Harga</label>
                                                                        <input type="text" class="form-control" readonly
                                                                            value="{{ ucwords(str_replace('_', ' ', $schedule->packageDetail->price_type ?? '-')) }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Harga</label>
                                                                        <input type="text" class="form-control" readonly
                                                                            value="Rp {{ number_format($schedule->packageDetail->price ?? 0, 0, ',', '.') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Kuota</label>
                                                                        <input type="number" name="quota" min="1"
                                                                            class="form-control" required
                                                                            value="{{ $schedule->quota }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Sisa Kuota</label>
                                                                        <input type="number" name="remaining_quota"
                                                                            min="0" class="form-control" required
                                                                            value="{{ $schedule->remaining_quota }}">
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex justify-content-end gap-2">
                                                                    <button type="button" class="btn btn-outline-danger"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="deleteModal-{{ $schedule->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel-{{ $schedule->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content radius-16 bg-base border border-danger">
                                                        <div class="modal-header py-16 px-24 border-bottom border-danger">
                                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body p-24">
                                                            <p>
                                                                Apakah kamu yakin ingin menghapus jadwal untuk
                                                                <strong>{{ $schedule->packageDetail->option_name ?? 'TIDAK DIKETAHUI' }}</strong>
                                                                pada tanggal
                                                                <strong>{{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('d F Y') }}</strong>?
                                                            </p>
                                                            <form
                                                                action="{{ route('admin.package_schedules.deleteDay', $schedule->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="d-flex justify-content-end gap-2">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            const dataTables = {};

            document.querySelectorAll('.datatable-jenis').forEach(function(table) {
                const id = table.getAttribute('id');
                dataTables[id] = new DataTable(table, {
                    responsive: true,
                    autoWidth: false
                });
            });

            // Adjust saat tab jenis paket dibuka
            document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(function(tabBtn) {
                tabBtn.addEventListener('shown.bs.tab', function(event) {
                    const targetId = event.target.getAttribute('data-bs-target'); // contoh: #jenis-porter-tenda
                    const tableId = targetId.replace('#jenis-', 'datatable-jenis-');

                    if (dataTables[tableId]) {
                        setTimeout(() => {
                            dataTables[tableId].columns.adjust().responsive.recalc();
                        }, 200);
                    }
                });
            });
        </script>
    @endpush
@endsection
