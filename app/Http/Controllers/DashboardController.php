<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index(Request $request): View|RedirectResponse
    {
        // Pastikan user sudah login dan terverifikasi emailnya
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        // Tampilkan halaman dashboard
        return view('admin.dashboard.index');
    }
}
