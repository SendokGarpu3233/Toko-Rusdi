<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function getAbout() {
    $biodata = [
        'nama' => 'wawan',
        'umur' => '19',
        'alamat' => 'jl example'
    ];
        return view('pages.about', $biodata);
    }
}
