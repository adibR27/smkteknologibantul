<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiPublicController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first();

        return view('visi-misi.index', compact('visiMisi'));
    }
}
