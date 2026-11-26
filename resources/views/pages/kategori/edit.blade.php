@extends('layouts.master')
@section('konten')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Kategori</h2>
    <a href="/Kategori" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
</div>
<div class="card shadow md-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Update Kategori</h6>
    </div>
    <div class="card-body">
        <form action="/Kategori/{{$kategori->id_kategori}}" method="POST">
            @method('PUT')     
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                        <input type="text"  name='nama_kategori'  class="form-control" value="{{$kategori->nama_kategori}}">
                        @error('nama_kategori')
                            <div id="emailHelp" class="form-text text-danger">Tidak boleh kosong</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <label for="floatingTextarea2">Deskripsi</label>
                        <textarea class="form-control" name='deskripsi'  placeholder="Leave a comment here" >{{$kategori->deskripsi}}</textarea>       
                    </div>
                </div>
                <div class="col-sm-12 mt-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection