<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriPublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeri = Galeri::with('uploader')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('galeri.index', compact('galeri'));
    }
}
