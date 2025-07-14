    @extends('admin.layouts.main')

    @section('content')
    <div class="row gy-4">
        <div class="col-12">
            <div class="card basic-data-table">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Jadwal Paket per Bulan</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table bordered-table mb-0" id="scheduleTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Bulan</th>
                                <th>Total Kuota</th>
                                <th>Sisa Kuota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scheduleGroups as $index => $group)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $group->package->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($group->month . '-01')->translatedFormat('F Y') }}</td>
                                    <td>{{ $group->total_quota }}</td>
                                    <td>{{ $group->total_remaining_quota }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('admin.package-schedules.show', ['package_id' => $group->package_id, 'month' => $group->month]) }}"
                                        class="btn btn-primary btn-sm">Detail</a>
                                        <form action="{{ route('admin.package-schedules.destroyMonth', ['package_id' => $group->package_id, 'month' => $group->month]) }}"
                                            method="POST" onsubmit="return confirm('Hapus semua jadwal bulan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
