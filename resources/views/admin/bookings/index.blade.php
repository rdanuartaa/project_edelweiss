@extends('admin.layouts.main')

@section('pageTitle', 'Kelola Booking')
@section('breadcrumb', 'Kelola Booking')

@section('content')
<div class="card basic-data-table">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Booking</h5>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0" id="dataTable">
            <thead>
                <tr>
                    <th class="text-start">No</th>
                    <th class="text-start">Kode Booking</th>
                    <th class="text-start">Nama Paket</th>
                    <th class="text-start">Jenis Paket</th>
                    <th class="text-start">Tanggal Trip</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $index => $booking)
                    <tr>
                        <td class="text-start">{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $booking->booking_code }}</td>
                        <td class="text-start">{{ $booking->schedule->package->name ?? '-' }}</td>
                        <td class="text-start">{{ $booking->schedule->packageDetail->option_name ?? '-' }}</td>
                        <td class="text-start">
                            {{ \Carbon\Carbon::parse($booking->schedule->trip_date)->translatedFormat('d F Y') }}
                        </td>
                        <td>
                            @php
                                $badgeClass = match ($booking->status ?? '') {
                                    'paid', 'approved' => 'success',
                                    'pending' => 'warning',
                                    'rejected', 'cancelled' => 'danger',
                                    default => 'secondary',
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($booking->status ?? '-') }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center"
                                title="Lihat">
                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new DataTable('#dataTable');
    });
</script>
@endpush
@endsection
