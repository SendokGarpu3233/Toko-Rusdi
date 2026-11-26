<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function getAbout()
    {
        $kategori = DB::table('tb_kategori')
            ->whereNull('tb_kategori.deleted_at')
            ->leftJoin('tb_produk', function ($join) {
                $join->on('tb_kategori.id_kategori', '=', 'tb_produk.kategori_id')
                     ->whereNull('tb_produk.deleted_at');
            })
            ->select('tb_kategori.nama_kategori', DB::raw('count(tb_produk.id_produk) as total'))
            ->groupBy('tb_kategori.id_kategori', 'tb_kategori.nama_kategori')
            ->get();

        return view('pages.about', ['kategori' => $kategori]);
    }
}
