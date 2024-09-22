<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Home page for all authenticated users
    public function index()
    {
        return view('home');
    }

    // Admin page, restricted to admins only
    public function admin()
    {
        return view('admin');
    }
}
