<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class produk extends Model
{
    use SoftDeletes;
    //inisialisasi tabel produk
    protected $table = "tb_produk";
    //inisialisasi primary key dlm tabel
    protected $primaryKey = "id_produk";
    //inisialisasi data yang dapat di isi
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'harga', 
        'deskripsi_produk', 
        'stok', 
        'kategori_id',
        'gambar',
    ];
    

    public function kategori() {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }
}
