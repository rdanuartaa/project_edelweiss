<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;


class AdminBookingController extends Controller
{
    // Tampilkan daftar semua booking
    public function index()
    {
        $bookings = Booking::with(['user', 'package'])->latest()->get(); // gunakan get(), bukan paginate()

        return view('admin.bookings.index', [
            'pageTitle' => 'Kelola Booking',
            'breadcrumb' => 'Kelola Booking',
            'bookings' => $bookings,
        ]);
    }

    // Tampilkan detail booking
    public function show($id)
    {
        $booking = Booking::with(['user', 'package', 'details'])->findOrFail($id);

        return view('admin.bookings.show', [
            'pageTitle' => 'Detail Booking',
            'breadcrumb' => 'Detail Booking',
            'booking' => $booking,
        ]);
    }

    // Setujui booking
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'paid';
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil disetujui.');
    }

    // Tolak booking
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking ini tidak bisa ditolak.');
        }

        $booking->status = 'rejected';
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil ditolak.');
    }

    // Batalkan booking
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil dibatalkan.');
    }

    // Hapus booking
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
