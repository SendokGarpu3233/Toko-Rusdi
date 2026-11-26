@extends('layouts.master')
@section('title', 'Edit Produk')

@section('konten')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Produk</h2>
    <a href="/produk" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Update Data Produk</h6>
    </div>

    <div class="card-body">
        <form action="/produk/{{ $produk->id_produk }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <!-- Nama Produk -->
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}">
                        @error('nama_produk')
                            <div class="form-text text-danger">tidak boleh kosong</div>
                        @enderror
                    </div>
                </div>

                <!-- Harga -->
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Harga <span class="text-danger">*</span></label>
                        <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}">
                        @error('harga')
                            <div class="form-text text-danger">tidak boleh kosong</div>
                        @enderror
                    </div>
                </div>

                <!-- Stok -->
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}">
                        @error('stok')
                            <div class="form-text text-danger">tidak boleh kosong</div>
                        @enderror
                    </div>
                </div>

                <!-- Kategori -->
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control" name="kategori">
                            <option value="">Pilih kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori }}" {{ $item->id_kategori == $produk->kategori_id ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="form-text text-danger">tidak boleh kosong</div>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi_produk" rows="3" placeholder="Masukkan deskripsi produk...">{{ $produk->deskripsi_produk }}</textarea>
                    </div>
                </div>

                <!-- Foto Produk -->
                <div class="col-12 mt-2">
                    <label class="form-label font-weight-bold">Foto Produk</label>
                    <div class="p-3 border rounded bg-light">
                        <div class="row align-items-center">
                            <!-- Foto Saat Ini -->
                            <div class="col-auto">
                                @if ($produk->gambar)
                                    <img src="{{ asset('uploads/' . $produk->gambar) }}" class="rounded shadow-sm border bg-white" style="width: 80px; height: 80px; object-fit: cover;" alt="Foto Produk" id="previewGambar">
                                @else
                                    <img id="previewGambar" src="" class="rounded shadow-sm border bg-white d-none" style="width: 80px; height: 80px; object-fit: cover;" alt="Foto Produk">
                                    <div  id="iconPlaceholder"  class="rounded shadow-sm border bg-white d-flex align-items-center justify-content-center text-muted" style="width: 80px; height: 80px;">
                                        <i class="fas fa-image fa-2x"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Input Ganti Foto -->
                            <div class="col">
                                <input type="file" name="gambar" class="form-control-file" accept="image/*" id="inputGambar" onchange="previewImage()">
                                <small class="text-muted d-block mt-1">Pilih file baru jika ingin mengganti foto saat ini (opsional).</small>
                                @error('gambar')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="col-sm-12 mt-4">
                    <button type="submit" class="btn btn-primary">Update data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage() {
        const input = document.getElementById('inputGambar');
        const preview = document.getElementById('previewGambar');
        const iconPlaceholder = document.getElementById('iconPlaceholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none'); // Munculkan gambar
                if (iconPlaceholder) {
                    iconPlaceholder.classList.remove('d-flex');
                    iconPlaceholder.classList.add('d-none'); // Sembunyikan icon abu-abu
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection 