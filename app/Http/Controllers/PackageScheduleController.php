<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PackageScheduleController extends Controller
{
    public function index()
    {
        $packages = Package::all();

        $scheduleGroups = DB::table('package_schedules')
            ->select(
                'package_id',
                DB::raw("DATE_FORMAT(date, '%Y-%m') as month"),
                DB::raw('SUM(quota) as total_quota'),
                DB::raw('SUM(remaining_quota) as total_remaining_quota')
            )
            ->groupBy('package_id', DB::raw("DATE_FORMAT(date, '%Y-%m')"))
            ->orderBy('month', 'desc')
            ->get();

        foreach ($scheduleGroups as $group) {
            $group->package = $packages->firstWhere('id', $group->package_id);
        }

        return view('admin.package_schedules.index', [
            'scheduleGroups' => $scheduleGroups,
            'packages' => $packages,
            'pageTitle' => 'Kelola Jadwal Paket Trip',
            'breadcrumb' => 'Kelola Jadwal Paket Trip'
        ]);

    }

    public function show($id)
    {
        $package = Package::with('schedules.packageDetail')->findOrFail($id);

        // Ambil bulan dari request atau default ke bulan sekarang
        $month = request('month', now()->format('Y-m'));

        // Filter data bulan tersebut
        $filtered = $package->schedules->filter(function ($item) use ($month) {
            return \Carbon\Carbon::parse($item->date)->format('Y-m') === $month;
        });

        // Group berdasarkan jenis paket dan sort berdasarkan nama jenis (option_name)
        $groupedByJenis = $filtered->groupBy(function ($item) {
            return $item->packageDetail->option_name ?? 'Tidak Diketahui';
        })->sortKeys(); // Tambahkan ini agar urut stabil

        return view('admin.package_schedules.show', [
            'package' => $package,
            'month' => $month,
            'groupedByJenis' => $groupedByJenis,
            'pageTitle' => 'Detail Jadwal Paket Trip',
            'breadcrumb' => 'Detail Jadwal Paket Trip'
        ]);

    }

    public function generate(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'month' => 'required|date_format:Y-m',
            'quota' => 'required|integer|min:1',
        ]);

        $package = Package::with('options')->findOrFail($request->package_id);
        $month = $request->month;
        $quotaPerOptionPerDay = $request->quota;

        // Cek apakah sudah ada jadwal di bulan tersebut untuk paket ini
        $existing = PackageSchedule::where('package_id', $package->id)
            ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$month])
            ->exists();

        if ($existing) {
            // Jika sudah ada, kembalikan ke halaman dengan error
            return redirect()->back()->with('error', 'Jadwal untuk bulan tersebut sudah ada. Silakan hapus terlebih dahulu jika ingin generate ulang.');
        }

        // Lanjut generate karena belum ada
        $daysInMonth = Carbon::parse($month . '-01')->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

            foreach ($package->options as $option) {
                PackageSchedule::create([
                    'package_id' => $package->id,
                    'package_detail_id' => $option->id,
                    'date' => $date,
                    'quota' => $quotaPerOptionPerDay,
                    'remaining_quota' => $quotaPerOptionPerDay,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Kuota berhasil digenerate untuk bulan tersebut.');
    }


    public function destroyMonth($package_id, $month)
    {
        PackageSchedule::where('package_id', $package_id)
            ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$month])
            ->delete();

        return redirect()->route('admin.package_schedules.index')
            ->with('success', 'Semua jadwal bulan ini berhasil dihapus.');
    }

    public function updateQuota(Request $request, $id)
    {
        $request->validate([
            'quota' => 'required|integer|min:1',
            'remaining_quota' => 'required|integer|min:0',
        ]);

        $schedule = PackageSchedule::findOrFail($id);

        $oldQuota = $schedule->quota;
        $oldRemaining = $schedule->remaining_quota;

        $newQuota = $request->quota;
        $newRemaining = $request->remaining_quota;

        $schedule->quota = $newQuota;

        // Jika quota berubah dan remaining sebelumnya == quota, maka remaining ikut disesuaikan
        if ($oldQuota != $newQuota && $oldRemaining == $oldQuota) {
            $schedule->remaining_quota = $newQuota;
        }
        // Jika quota berubah dan remaining lama > quota baru, turunkan remaining ke quota baru
        elseif ($oldQuota != $newQuota && $oldRemaining > $newQuota) {
            $schedule->remaining_quota = $newQuota;
        }
        // Jika tidak, gunakan input dari user (misal hanya ubah remaining saja)
        else {
            if ($newRemaining > $newQuota) {
                return redirect()->back()->with('error', 'Sisa kuota tidak boleh lebih besar dari total kuota.');
            }
            $schedule->remaining_quota = $newRemaining;
        }

        $schedule->save();

        return redirect()->back()->with('success', 'Data kuota berhasil diperbarui.');
    }

    public function destroyDay($id)
    {
        $schedule = PackageSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }

}
