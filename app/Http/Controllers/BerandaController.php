<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function getBeranda() 
    {
        // Mengambil data produk ringkas untuk grafik (terhubung ke kategori)
        $semuaProduk = produk::select('nama_produk', 'stok', 'kategori_id')->get();

        // Data ringkasan
        $totalProduk   = produk::count();
        $totalKategori = Kategori::count();
        $totalStok     = produk::sum('stok');

        // 1. Data produk dengan stok menipis (< 10 unit)
        $stokMenipis = produk::where('stok', '<', 10)->orderBy('stok', 'asc')->get();

        // 2. Data jumlah produk per kategori (abaikan yang sudah di-soft-delete)
        $produkPerKategori = DB::table('tb_kategori')
            ->whereNull('tb_kategori.deleted_at')
            ->leftJoin('tb_produk', function ($join) {
                $join->on('tb_kategori.id_kategori', '=', 'tb_produk.kategori_id')
                     ->whereNull('tb_produk.deleted_at');
            })
            ->select('tb_kategori.id_kategori', 'tb_kategori.nama_kategori', DB::raw('count(tb_produk.id_produk) as total'))
            ->groupBy('tb_kategori.id_kategori', 'tb_kategori.nama_kategori')
            ->get();

        return view('pages.beranda', [
            'semuaProduk'       => $semuaProduk,
            'totalProduk'       => $totalProduk,
            'totalKategori'     => $totalKategori,
            'totalStok'         => $totalStok,
            'stokMenipis'       => $stokMenipis,
            'produkPerKategori' => $produkPerKategori,
        ]);
    }
}
