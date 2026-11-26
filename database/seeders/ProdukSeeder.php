<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('tb_kategori')->insert([
        [
            'nama_kategori'=>'Hp',
            'deskripsi'=>'ini adalah sebuah keterangan contoh ',
           
        ], 
        
        [
            'nama_kategori'=>'tv',
            'deskripsi'=>'ini adalah sebuah keterangan contoh ',
        ],
        ]);

        DB::table('tb_produk')->insert([
        [
            'kode_produk'=>'IP17PM',
            'nama_produk'=>'iPhone 17 Pro Max',
            'harga'=> 20000000,
            'deskripsi_produk'=>'ini adalah sebuah deskripsi contoh ',
            'stok'=>'50 ',
            'kategori_id'=>'1',
            'created_at'=>now(),

        ],[
        
            'kode_produk'=>'STV01',
            'nama_produk'=>'Smart TV samsung 50',
            'harga'=> 8000000,
            'deskripsi_produk'=>'ini adalah sebuah deskripsi contoh ',
            'stok'=>'30 ',
            'kategori_id'=>'2',
            'created_at'=>now(),

        ]
    ]);
    }
}
