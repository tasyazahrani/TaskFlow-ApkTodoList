<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Memastikan hanya pengguna yang sudah login yang dapat mengakses halaman dashboard
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard');
    }
}

