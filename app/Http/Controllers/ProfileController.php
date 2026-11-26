<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //halaman form edit profil
    public function edit() {
        $user = Auth::User();

        return view('pages.profil.edit', [
            'user' => $user
        ]);
    }

    //proses update data profil
    public function update(request $request) {
        $user = Auth::User();
        $request->validate([
            'name'     => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s\.]+$/'],
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'foto'     => 'nullable|image|mimes:jpg,png,jpeg,webp|max:5120',          
        ], [
            'name.regex' => 'Nama hanya boleh berisi huruf dan spasi!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);

        $nama_foto = $user->foto;

        //$jika mengunggah foto profil baru
        if ($request->hasfile('foto')) {
            $file = $request -> file('foto');
            $nama_foto = time() . '_' . 
            $file->getClientOriginalName();
            $file->move(public_path('uploads'), $nama_foto);
        }


        //data yang akan di update
        $dataUpdate = [
            'name' => $request->name,
            'email' => $request->email,
            'foto' => $nama_foto,
        ];

        //input pw diisi, ubah pwnya
         if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        // Simpan perubahan ke database
        $user->update($dataUpdate);

         return redirect('/profil')->with('pesan', 'Profil berhasil diperbarui!');
    }
}
