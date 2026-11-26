<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;






class ProdukController extends Controller
{
    public function index(request $request) {
        $toko = [
            'nama_toko' => 'toko online wawan',
            'alamat' => 'indonesia',
            'tipe_toko' => 'toko resmi'
        ];

        $search = $request->keyword;

        $produk = produk::when($search, function($query,$search) {
            return $query->where('nama_produk', 'like', "%{$search}%")
            ->orWhere('deskripsi_produk', 'like', "%{$search}%");
        }) 
        ->leftJoin('tb_kategori', function ($join) {
            $join->on('tb_produk.kategori_id', '=', 'tb_kategori.id_kategori')
                 ->whereNull('tb_kategori.deleted_at');
        })
        ->select('tb_produk.*', 'tb_kategori.nama_kategori')
        ->get(); //query untuk mengambil semua data yang ada di tb_produk

        $data_kategori = kategori::get();

        return view('pages.produk.show', [
            'data_toko'=>$toko,
            'data_produk'=>$produk,
            'data_kategori'=>$data_kategori,
        ]);
    }

    public function create() {
        $data_kategori = kategori::get();
        return view('pages.produk.add', [
            'data'=>$data_kategori
        ]);
        
    }

    public function store(request $request) {
        $request->validate([
            'nama_produk'      => ['required', 'string', 'max:140', 'regex:/^[a-zA-Z0-9\s\-\/\.&()]+$/'],
            'harga'            => 'required|numeric|min:1',
            'deskripsi_produk' => 'required',
            'stok'             => 'required|integer|min:0',
            'kategori'         => 'required',
            'gambar'           => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:12480'
        ], [
            'nama_produk.regex' => 'Nama produk tidak boleh mengandung simbol aneh!',
            'harga.min'         => 'Harga harus lebih dari 0!',
            'stok.min'          => 'Stok tidak boleh bernilai minus!',
        ]);


        $nama_gambar = null;
        if ($request ->file('gambar')) {
            $file = $request->file('gambar');
            
            if (! $file->isvalid()) {
                return back()->withErrors([
                    'gambar' => 'file gagal diupload: ' . $file->getErrorMessage() . '.Coba gunakan foto dengan ukuran lebih kecil (<2mb'
                    
                ])->withInput();
            }
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $nama_gambar);
            
        }

        //menambahkan data ke tabel produk
        produk::create([
            'kode_produk'=> str::random(5),
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi_produk' => $request->deskripsi_produk,
            'kategori_id' =>$request->kategori,
            'stok' =>$request->stok,
            'gambar' => $nama_gambar,

        ]);

        return redirect('/produk')->with('pesan', 'Produk berhasil ditambahkan');
    }

    public function show($id_produk){
        $data = produk::findOrFail($id_produk); 

        return view('pages.produk.detail', ['produk' => $data]);
    }

    //menampilkan halaman edit
    public function edit($id_produk){
        $data = produk::findOrFail($id_produk);
        $data_kategori = kategori::get();

        return view('pages.produk.edit', [
            'produk' =>$data,
            'kategori' => $data_kategori,
        ]);
    }

    public function update($id_produk,Request $request){
        
        $request->validate([
            'nama_produk'      => ['required', 'string', 'max:140', 'regex:/^[a-zA-Z0-9\s\-\/\.&()]+$/'],
            'harga'            => 'required|numeric|min:1',
            'stok'             => 'required|integer|min:0',
            'kategori'         => 'required',
            'deskripsi_produk' => 'required',
            'gambar'           => 'nullable|image|mimes:jpg,png,jpeg,webp|max:12480',
        ], [
            'nama_produk.regex' => 'Nama produk tidak boleh mengandung simbol aneh!',
            'harga.min'         => 'Harga harus lebih dari 0!',
            'stok.min'          => 'Stok tidak boleh bernilai minus!',
        ]);

        // tambah gambar di edit
        $produk = produk::findOrFail($id_produk);
        $nama_gambar = $produk->gambar; //tetap menggunakan gambar lama

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . '_ ' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $nama_gambar);
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi_produk' => $request->deskripsi_produk,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori,
            'gambar' => $nama_gambar,
        ]);


        produk::where('id_produk',$id_produk)->update([
            'nama_produk'=>$request->nama_produk,
            'harga'=>$request->harga,
            'deskripsi_produk'=>$request->deskripsi_produk,
            'stok'=>$request->stok,
            'kategori_id'=>$request->kategori,
        ]);
 
        return back()->with('pesan', 'produk berhasil di update');
    }


    public function destroy($id_produk){
        //query hapus data
        $produk = produk::findOrFail($id_produk);
        $nama_produk = $produk->nama_produk;
        $produk->delete();

        return redirect('/produk')->with('pesan', 'Produk ' . $nama_produk . ' berhasil dihapus');
    }



    //Daftar sampah produk (khusus bagian Super admin)

    public function trash() {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'hanya Super Admin yang dapat mengakses halaman ini!');
        }

        $produkSampah   = produk::onlyTrashed()->get();
        $kategoriSampah = kategori::onlyTrashed()->get();

        return view('pages.produk.trash', [
            'data_sampah'          => $produkSampah,
            'data_sampah_kategori' => $kategoriSampah,
        ]);
    }

    //mengembalikan produk yang sudah terhapus
    public function restore($id_produk) {
        if (Auth::user()->role !== 'super_admin') {
            abort(403);
        }

        produk::onlyTrashed()->where('id_produk', $id_produk)->restore();
        return redirect('/produk/trash')->with('pesan', 'produk berhasil dipulihkan');
    }


    //menghapus secara permanent dari database
    public function forceDelete($id_produk) {
        if (Auth::user()->role !== 'super_admin') {
            abort(403);
        }

        $produk = produk::onlyTrashed()->where('id_produk', $id_produk)->firstOrFail();

        if ($produk->gambar && file_exists(public_path('uploads/'. $produk->gambar))) {
            unlink(public_path('uploads/' . $produk->gambar));
        }

        $produk->forceDelete();

        return redirect('/produk/trash')->with('pesan', 'Produk berhasil dihapus secara permanen!');
    }



}
 