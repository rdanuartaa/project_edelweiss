<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageDetail;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('options.facilities')->get();

        return view('admin.packages.index', [
            'packages' => $packages,
            'pageTitle' => 'Kelola Paket Trip',
            'breadcrumb' => 'Kelola Paket Trip'
        ]);
    }

    public function create()
    {
        return view('admin.packages.create', [
            'pageTitle' => 'Tambah Paket Trip',
            'breadcrumb' => 'Tambah Paket Trip'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'nullable|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'banner' => 'nullable|image',
        'poster' => 'nullable|image',
        'options' => 'required|array',
        'options.*.option_name' => 'required|string|max:255',
        'options.*.price' => 'required|numeric',
        'options.*.price_type' => 'required|in:per_orang,per_jeep',
        'options.*.duration' => 'required|string|max:255',
        'options.*.facilities' => 'nullable|array',
        'options.*.facilities.*' => 'nullable|string|max:255',
        ]);


        // Upload gambar
        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        // Simpan data utama
        $package = Package::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'banner' => $validated['banner'] ?? null,
            'poster' => $validated['poster'] ?? null,
        ]);

        // Simpan setiap opsi
        foreach ($validated['options'] as $optionData) {
            $option = PackageDetail::create([
                'package_id' => $package->id,
                'option_name' => $optionData['option_name'],
                'duration' => $optionData['duration'],
                'price' => $optionData['price'],
                'price_type' => $optionData['price_type'],
            ]);

            // Simpan fasilitas per opsi
            foreach ($optionData['facilities'] ?? [] as $facilityName) {
                if ($facilityName) {
                    Facility::create([
                        'package_detail_id' => $option->id,
                        'name' => $facilityName,
                    ]);
                }
            }
        }

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        $package->load('options.facilities');

        return view('admin.packages.edit', [
            'package' => $package,
            'pageTitle' => 'Edit Paket Trip',
            'breadcrumb' => 'Edit Paket Trip'
        ]);
    }

    public function update(Request $request, Package $package)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'nullable|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'banner' => 'nullable|image',
        'poster' => 'nullable|image',
        'options' => 'required|array',
        'options.*.option_name' => 'required|string|max:255',
        'options.*.price' => 'required|numeric',
        'options.*.price_type' => 'required|in:per_orang,per_jeep',
        'options.*.duration' => 'required|string|max:255',
        'options.*.facilities' => 'nullable|array',
        'options.*.facilities.*' => 'nullable|string|max:255',
    ]);

    // Ganti file banner jika ada
    if ($request->hasFile('banner')) {
        if ($package->banner) {
            Storage::disk('public')->delete($package->banner);
        }
        $validated['banner'] = $request->file('banner')->store('banners', 'public');
    }

    // Ganti file poster jika ada
    if ($request->hasFile('poster')) {
        if ($package->poster) {
            Storage::disk('public')->delete($package->poster);
        }
        $validated['poster'] = $request->file('poster')->store('posters', 'public');
    }

    // Update data utama paket
    $package->update([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'location' => $validated['location'],
        'latitude' => $validated['latitude'],
        'longitude' => $validated['longitude'],
        'banner' => $validated['banner'] ?? $package->banner,
        'poster' => $validated['poster'] ?? $package->poster,
    ]);

    // Simpan ID dari opsi yang diproses untuk menjaga data lama
    $processedOptionIds = [];

    foreach ($validated['options'] as $optionData) {
        // Coba cari apakah ada opsi lama dengan nama yang sama
        $option = $package->options()
            ->where('option_name', $optionData['option_name'])
            ->first();

        if ($option) {
            // Update opsi lama
            $option->update([
                'duration' => $optionData['duration'],
                'price' => $optionData['price'],
                'price_type' => $optionData['price_type'],
            ]);

            // Hapus semua fasilitas lama lalu buat ulang
            $option->facilities()->delete();
        } else {
            // Buat opsi baru
            $option = PackageDetail::create([
                'package_id' => $package->id,
                'option_name' => $optionData['option_name'],
                'duration' => $optionData['duration'],
                'price' => $optionData['price'],
                'price_type' => $optionData['price_type'],
            ]);
        }

        // Simpan ID opsi yang diproses
        $processedOptionIds[] = $option->id;

        // Simpan fasilitas baru
        foreach ($optionData['facilities'] ?? [] as $facilityName) {
            if ($facilityName) {
                Facility::create([
                    'package_detail_id' => $option->id,
                    'name' => $facilityName,
                ]);
            }
        }
    }

    // Hapus opsi lama yang tidak ikut diproses (dan tidak memiliki jadwal)
    $package->options()->whereNotIn('id', $processedOptionIds)->get()->each(function ($oldOption) {
        // Cek apakah punya jadwal?
        if ($oldOption->schedules()->count() === 0) {
            $oldOption->facilities()->delete();
            $oldOption->delete();
        }
    });

    return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui.');
}

    public function destroy(Package $package)
    {
        // Hapus fasilitas dan opsi
        foreach ($package->options as $option) {
            $option->facilities()->delete();
            $option->delete();
        }

        // Hapus file
        if ($package->banner && Storage::disk('public')->exists($package->banner)) {
            Storage::disk('public')->delete($package->banner);
        }

        if ($package->poster && Storage::disk('public')->exists($package->poster)) {
            Storage::disk('public')->delete($package->poster);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus.');
    }

    public function show($id)
    {
        $package = Package::with('options.facilities')->findOrFail($id);

        // Ambil 5 paket terbaru lainnya, kecuali yang sedang ditampilkan
        $latestPackages = Package::where('id', '!=', $id)
                                ->latest()
                                ->take(5)
                                ->get();

        return view('admin.packages.show', [
            'package' => $package,
            'latestPackages' => $latestPackages, // <- kirim ke view
        ]);
    }
}
