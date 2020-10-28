<?php

namespace App\Http\Controllers;

use App\Filial;
use App\Http\Resources\FilialsCollection;
use Illuminate\Http\Request;

class FilialController extends Controller
{
    public function index() {
        return new FilialsCollection(Filial::all());
    }
}
