<?php

namespace App\Http\Controllers;

use App\Worksheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::user()->hasAnyRole(['admin', 'head'])) {
            return redirect()->route('users');
        }
        return redirect()->route('worksheets.index');
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
    public function worksheet(Worksheet $worksheet) {
        return view('worksheet', compact('worksheet'));
    }
    public function createWorksheet() {
        return view('worksheet');
    }
}
