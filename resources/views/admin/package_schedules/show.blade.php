@extends('admin.layouts.main')

@section('content')
<div class="row gy-4">
    <div class="col-12">
        <div class="card basic-data-table">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Detail Jadwal: {{ $package->name }} - {{ \Carbon\Carbon::parse($month . '-01')->translatedFormat('F Y') }}</h5>
                <a href="{{ route('admin.package-schedules.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table bordered-table mb-0" id="dailyScheduleTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kuota</th>
                            <th>Sisa Kuota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('d F Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.package-schedules.updateQuota', $schedule->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quota" value="{{ $schedule->quota }}" min="1" class="form-control form-control-sm w-auto" style="width: 80px;">
                                        <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                    </form>
                                </td>
                                <td>{{ $schedule->remaining_quota }}</td>
                                <td>
                                    <form action="{{ route('admin.package-schedules.deleteDay', $schedule->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal tanggal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus Hari</button>
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
    new DataTable('#dailyScheduleTable');
</script>
@endpush
@endsection
