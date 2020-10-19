<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::user()->hasAnyRole(['admin', 'head'])) {
            return redirect()->route('users');
        }
        return redirect()->route('worksheets');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function worksheets() {
        return view('worksheets');
    }
    public function worksheet() {
        return view('worksheet');
    }
}
