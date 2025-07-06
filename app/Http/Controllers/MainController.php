<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index()
    {
        return view('main.index');
    }

    public function trip()
    {
        return view('main.trip');
    }

    public function tutorial()
    {
        return view('main.tutorial');
    }

    public function about()
    {
        return view('main.about');
    }

    public function artikel()
    {
        return view('main.artikel');
    }

}
