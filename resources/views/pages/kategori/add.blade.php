@extends('layouts.master')
@section('konten')
<a href="/Kategori"class="btn btn-secondary mb-3 "><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
<div class="card">
    <div class="card-header">Tambah Kategori</div>
    <div class="card-body">
        <form action="/Kategori" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text"  name='nama_kategori'  class="form-control" value="{{old('nama_kategori')}}">
                        @error('nama_kategori')
                            <div id="emailHelp" class="form-text text-danger">Tidak boleh kosong</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="col-12">
                    <div class="form-floating">
                        <p>Deskripsi<span class="text-danger">*</span></p>
                        <textarea class="form-control" name='deskripsi'  placeholder="Leave a comment here" ></textarea>
                        <label for="floatingTextarea2" class="form-label"></label>
                         @error('deskripsi')
                            <div id="emailHelp" class="form-text text-danger">Tidak boleh kosong</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 mt-4">
                    <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                </div>
            </div>
        </form>
    </div>

</div>




@endsection