@extends('layouts.master')
@section('konten')
<a href="/produk"class="btn btn-secondary mb-3 "><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
<div class="card shadow md-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Produk</h6>         
    </div>
    <div class="card-body">
        <form action="/produk" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text"  name='nama_produk'  class="form-control" value="{{old('nama_produk')}}">
                        @error('nama_produk')
                            <div id="emailHelp" class="form-text text-danger">tidak boleh kosong</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Harga <span class="text-danger">*</span></label>
                            <input type="number"  name='harga'  class="form-control" value="{{old('harga')}}">
                            @error('harga')
                                <div id="emailHelp" class="form-text text-danger">tidak boleh kosong</div>
                            @enderror
                        </div>
                    </div>
                <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number"  name='stok'  class="form-control" value="{{old('stok')}}">
                            @error('stok')
                                <div id="emailHelp" class="form-text text-danger">tidak boleh kosong</div>
                            @enderror
                        </div>
                    </div>
                 <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori">
                                <option value="" selected>Pilih kategori</option>
                                @foreach ($data as $item)
                                    <option value="{{$item->id_kategori}}" {{old('Kategori') == $item->id_kategori ? 'selected' : ''}}>{{$item->nama_kategori}}</option>
                                @endforeach
                                </select>
                            @error('kategori')
                                <div class="form-text text-danger">tidak boleh kosong</div>
                            @enderror
                        </div>
                    </div>   
                <div class="col-12">
                    <div class="form-floating">
                        <label for="floatingTextarea2">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" name='deskripsi_produk' placeholder="Masukkan deskripsi produk secara lengkap...">{{ old('deskripsi_produk') }}</textarea>
                        @error('deskripsi_produk')
                                <div class="form-text text-danger">tidak boleh kosong </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="mb-3">
                        <label class="form-label">Foto produk<span class="text-danger">*</span></label>
                        <div id="dropZone" onclick="document.getElementById('inputGambar').click()" style="border: 2px dashed #4e73df; border-radius:10px;padding: 25px; text-align: center;cursor: pointer; background: #f8f9fc;">
                            <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                            <p class="mb-0">Tarik & lepas gambar atau <b>klik disini untuk pilih</b></p>
                        </div>
                        <input type="file" name="gambar" class="d-none" accept="image/*" id="inputGambar" onchange="previewImage()">
                        @error('gambar')
                        <div class="form-text text-danger"> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <img id="imgPreview" src="" class="img-thumbnail d-none" style="max-height: 150px;">
                    </div>
                </div>
                <div class="col-sm-12 mt-4">
                    <button type="submit" class="btn btn-primary">Tambah data</button>
                </div>
            </div>
        </form>
    </div>

</div>
<script>
    function previewImage() {
        const input = document.getElementById('inputGambar');
        const preview = document.getElementById('imgPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }      
    }

    const dropZone = document.getElementById('dropZone');

        dropZone.addEventListener('dragover', e => {
            e.preventDefault();
            dropZone.style.background = '#eaecf4';
        });

        dropZone.addEventListener('dragleave' , () => {
            dropZone.style.background = '#f8f9fc';
        });

        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.style.background = '#f8f9fc';
            if (e.dataTransfer.files.length > 0) {
                const dt = new DataTransfer();
                dt.items.add(e.dataTransfer.files[0]);
                document.getElementById('inputGambar').files = dt.files
                previewImage();
            }
        }); 



</script>
@endsection