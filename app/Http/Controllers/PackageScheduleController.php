<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PackageScheduleController extends Controller
{
    public function index()
{
    // Ambil semua jadwal dan grupkan berdasarkan paket dan bulan
    $schedules = PackageSchedule::with('package')->get();

    $scheduleGroups = $schedules->groupBy(function ($item) {
        return $item->package_id . '-' . \Carbon\Carbon::parse($item->date)->format('Y-m');
    })->map(function ($group) {
        $first = $group->first();

        return (object)[
            'package_id' => $first->package_id,
            'package' => $first->package,
            'month' => \Carbon\Carbon::parse($first->date)->format('Y-m'),
            'total_quota' => $group->sum('quota'),
            'total_remaining_quota' => $group->sum('remaining_quota'),
        ];
    });

    return view('admin.package_schedules.index', compact('scheduleGroups'));
}


    public function show($packageId, $month)
    {
        $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        $package = Package::findOrFail($packageId);

        $schedules = PackageSchedule::where('package_id', $packageId)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        return view('admin.package_schedules.show', compact('package', 'month', 'schedules'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quota' => 'required|integer|min:1',
        ]);

        $schedule = PackageSchedule::findOrFail($id);
        $schedule->quota = $request->quota;

        if ($schedule->remaining_quota > $request->quota) {
            $schedule->remaining_quota = $request->quota;
        }

        $schedule->save();

        return back()->with('success', 'Kuota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $schedule = PackageSchedule::findOrFail($id);
        $schedule->delete();

        return back()->with('success', 'Jadwal harian berhasil dihapus.');
    }

    public function destroyMonth($packageId, $month)
    {
        $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        PackageSchedule::where('package_id', $packageId)
            ->whereBetween('date', [$startDate, $endDate])
            ->delete();

        return redirect()->route('admin.package-schedules.index')->with('success', 'Semua jadwal bulan tersebut berhasil dihapus.');
    }
}
