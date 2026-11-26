<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        
        //DB::table("tb_kategori')->get();
        $search = $request->keyword;

        $kategori = kategori::when($search, function($query,$search) {
            return $query->where('nama_kategori', 'like', "%{$search}%")
            ->orWhere('deskripsi', 'like', "%{$search}%");
        }) ->    get();

         return view('pages.kategori.show', compact('kategori'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kategori.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9\s&\-]+$/'],
            'deskripsi'     => 'required',
        ], [
            'nama_kategori.regex' => 'Nama kategori tidak boleh mengandung simbol aneh!',
        ]);

        kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/Kategori')->with('pesan', 'kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_kategori)
    {
        $data = Kategori::findOrFail($id_kategori); 

        return view('pages.kategori.detail', ['kategori' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_kategori)
    {
        $data = kategori::findOrFail($id_kategori);

        return view('pages.kategori.edit', [
            'kategori' =>$data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_kategori)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9\s&\-]+$/'],
            'deskripsi'     => 'required',
        ], [
            'nama_kategori.regex' => 'Nama kategori tidak boleh mengandung simbol aneh!',
        ]);

        Kategori::where('id_kategori',$id_kategori)->update([
            'nama_kategori'=>$request->nama_kategori,
            'deskripsi'=>$request->deskripsi,
        ]);
 
        return redirect('/Kategori')->with('pesan', 'kategori berhasil di perbaharui');
    }

    /**
     * soft delete kategori.
     */
    public function destroy(string $nama_kategori)
    {
        $kategori = kategori::findOrFail($nama_kategori);
        $nama_kategori = $kategori->nama_kategori;
        $kategori->delete();

        return redirect('/Kategori')->with('pesan', 'Kategori ' . $nama_kategori . ' berhasil dihapus');
    }

    // Pulihkan kategori dari sampah (khusus Super Admin)
    public function restore($id_kategori)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403);
        }

        Kategori::onlyTrashed()->where('id_kategori', $id_kategori)->restore();
        return redirect('/produk/trash')->with('pesan', 'Kategori berhasil dipulihkan!')->with('tab', 'kategori');
    }

    // Hapus permanen kategori dari database (khusus Super Admin)
    public function forceDelete($id_kategori)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403);
        }

        Kategori::onlyTrashed()->where('id_kategori', $id_kategori)->forceDelete();
        return redirect('/produk/trash')->with('pesan', 'Kategori berhasil dihapus permanen!')->with('tab', 'kategori');
    }
}
