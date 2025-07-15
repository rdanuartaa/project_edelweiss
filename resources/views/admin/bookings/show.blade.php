@extends('admin.layouts.main')

@section('pageTitle', 'Detail Booking')
@section('breadcrumb', 'Detail Booking')

@section('content')
<div class="row gy-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header border-bottom">
                <h6 class="text-xl mb-0">Informasi Booking</h6>
            </div>
            <div class="card-body d-flex flex-column gap-16 p-24">
                <div>
                    <strong>Nama Pemesan:</strong>
                    <p>{{ $booking->user->name ?? 'Pengguna tidak ditemukan' }}</p>
                </div>
                <div>
                    <strong>Kode Booking:</strong>
                    <p>{{ $booking->booking_code }}</p>
                </div>
                <div>
                    <strong>Tanggal Booking:</strong>
                    <p>{{ \Carbon\Carbon::parse($booking->created_at)->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <strong>Jadwal Trip:</strong>
                    <p>{{ $booking->schedule->package->name ?? '-' }} - {{ $booking->schedule->date ?? '-' }}</p>
                </div>
                <div>
                    <strong>Total Peserta:</strong>
                    <p>{{ $booking->participants }} orang</p>
                </div>
                <div>
                    <strong>Total Bayar:</strong>
                    <p>Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <strong>Status:</strong>
                    @php
                        $badgeClass = match($booking->status) {
                            'pending' => 'warning',
                            'paid', 'approved' => 'success',
                            'rejected', 'cancelled' => 'danger',
                            default => 'secondary'
                        };
                    @endphp
                    <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($booking->status) }}</span>
                </div>
                <div>
                    <strong>Bukti Transfer:</strong><br>
                    @if ($booking->transfer_proof)
                        <img src="{{ asset('storage/' . $booking->transfer_proof) }}" alt="Bukti Transfer"
                            class="img-fluid rounded" style="max-width: 300px;">
                    @else
                        <p class="text-muted">Belum ada bukti transfer.</p>
                    @endif
                </div>
            </div>
        </div>

        @if ($booking->status === 'pending')
        <div class="card mt-3">
            <div class="card-body d-flex justify-content-end gap-2">
                <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Tolak Booking</button>
                </form>
                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Setujui Booking</button>
                </form>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h6 class="mb-0">Peserta Booking</h6>
            </div>
            <div class="card-body p-3">
                @if($booking->details->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($booking->details as $detail)
                            <li class="list-group-item px-0">
                                <strong>{{ $detail->name }}</strong><br>
                                <small>{{ $detail->phone }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada data peserta.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
