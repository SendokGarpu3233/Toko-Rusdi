@extends('layouts.master')
@section('title','daftar produk')
     
@section('konten')
<h2>Produk</h2>
<hr>
<div class="card card-body">
<div class="row">
  <div class="col-md-4">
    <small class="text-muted">Nama Toko</small>
    <br>
    <strong style="font-weight: 900 !important;">{{$data_toko['nama_toko']}}</strong>
  </div>

  <div class="col-md-4">
    <small class="text-muted">Alamat</small>
    <br>
    <strong style="font-weight: 900 !important;">{{$data_toko['alamat']}}</strong>
  </div>

  <div class="col-md-4">
    <small class="text-muted">Tipe Toko</small>
    <br>
    <strong style="font-weight: 900 !important;">{{$data_toko['tipe_toko']}}</strong>
  </div>
</div>
</div>
<br>
<a href="/produk/create" type="button" class="btn btn-primary mb-4">Tambah Data</a>


<div class="card"> 
    <div class="card-header" d-flex justify-content-center align-items-center>

      <div style="max-width: 300px; width: 100%;">
        <input type="text" id="inputCari" onkeyup="filterTabel()" class="form-control" placeholder="Ketik untuk mencari data..">

      </div>
    </div>
  @if (session('pesan'))
      <div class='alert alert-primary m-3 mb-0'>{{session('pesan')}}</div>
  @endif
  @if ($errors->any())
      <div class="alert alert-danger m-3 mb-0">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kode produk</th>
      <th scope="col">Nama produk</th>
      <th scope="col">Harga</th>
      <th scope="col">Kategori</th>
      <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody id="tabelData">
    @foreach ($data_produk as $item)
       <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$item->kode_produk}}</td>
      <td>{{$item->nama_produk}}</td>
      <td>Rp {{number_format($item->harga)}}</td>
      <td>{{$item->nama_kategori ?? 'Tanpa kategori'}}</td>
      <td>{{$item->stok}}</td>
      <td class="text-nowrap" style="width: 1%;">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Detail{{$item->id_produk}}">Detail</button>
        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Edit{{$item->id_produk}}">Edit</button>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Hapus{{$item->id_produk}}">
            Hapus
        </button>
      </td>
    </tr> 
    @endforeach
    
  </tbody>
</table>
</div>
</div>

<div class="card-footer bg-white d-flex justify-content-between align-items-center py-2">
  <button type="button" id="btnPrevProduk" class="btn btn-sm btn-outline-secondary" onclick="gantiHalamanProduk(-1)">&lsaquo; Prev</button>
  <small class="text-muted" id="infoHalamanProduk">1/1</small>
  <button type="button" id="btnNextProduk" class="btn btn-sm btn-outline-secondary" onclick="gantiHalamanProduk(1)">Next &rsaquo;</button>
</div>
</div>

<!-- Modal -->
@foreach ($data_produk as $item)

<div class="modal fade" id="Hapus{{$item->id_produk}}" data-backdrop='static' aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action='/produk/{{$item->id_produk}}' method='POST' class="modal-content">
      @csrf
      @method('delete')
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
        <i class="far fa-fw fa-trash-alt"></i>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus produk <strong style="font-weight: 900 !important;">{{$item->nama_produk}}</strong> ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-primary">Iya</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Produk -->
<div class="modal fade" id="Edit{{$item->id_produk}}" data-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="/produk/{{$item->id_produk}}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      @method('PUT')

      <div class="modal-header">
        <h5 class="modal-title font-weight-bold text-primary">Edit Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <!-- Nama Produknya -->
          <div class="col-md-6 mb-3">
            <label>Nama Produk <span class="text-danger">*</span></label>
            <input type="text" name="nama_produk" class="form-control" value="{{ $item->nama_produk }}" required>
          </div>

          <!-- Harga -->
          <div class="col-md-6 mb-3">
            <label>Harga <span class="text-danger">*</span></label>
            <input type="number" name="harga" class="form-control" value="{{ $item->harga }}" required>
          </div>

          <!-- Stok -->
          <div class="col-md-6 mb-3">
            <label>Stok <span class="text-danger">*</span></label>
            <input type="number" name="stok" class="form-control" value="{{ $item->stok }}" required>
          </div>

          <!-- Kategori -->
          <div class="col-md-6 mb-3">
            <label>Kategori <span class="text-danger">*</span></label>
            <select name="kategori" class="form-control" required>
              <option value="">Pilih kategori</option>
              @foreach ($data_kategori as $kat)
                <option value="{{ $kat->id_kategori }}" {{ $kat->id_kategori == $item->kategori_id ? 'selected' : '' }}>
                  {{ $kat->nama_kategori }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Deskripsi -->
          <div class="col-12 mb-3">
            <label>Deskripsi <span class="text-danger">*</span></label>
            <textarea name="deskripsi_produk" class="form-control" rows="3" required>{{ $item->deskripsi_produk }}</textarea>
          </div>

          <!-- Foto Produk -->
          <div class="col-12">
            <label>Foto Produk (Opsional)</label>
            <div class="d-flex align-items-center p-2 border rounded bg-light">
              @if ($item->gambar)
                <img src="{{ asset('uploads/' . $item->gambar) }}" class="rounded mr-3 border" style="width: 60px; height: 60px; object-fit: cover;">
              @endif
              <input type="file" name="gambar" class="form-control-file" accept="image/*">
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Detail Produk -->
<div class="modal fade" id="Detail{{$item->id_produk}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold text-primary">Detail Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row align-items-center">
          <div class="col-md-4 text-center mb-3 mb-md-0">
            @if ($item->gambar)
              <img src="{{ asset('uploads/' . $item->gambar) }}" class="img-thumbnail rounded" style="max-height: 220px; object-fit: cover;">
            @else
              <div class="p-4 bg-light border rounded text-muted">
                <i class="fas fa-image fa-3x mb-2 d-block"></i>
                <small>Belum ada foto</small>
              </div>
            @endif
          </div>
          <div class="col-md-8">
            <table class="table table-borderless table-sm mb-0">
              <tr><td class="text-muted" style="width: 130px;">Kode Produk</td><td>: <span class="badge badge-secondary">{{ $item->kode_produk }}</span></td></tr>
              <tr><td class="text-muted">Nama Produk</td><td>: <strong>{{ $item->nama_produk }}</strong></td></tr>
              <tr><td class="text-muted">Harga</td><td>: <strong class="text-success">Rp {{ number_format($item->harga, 0, ',', '.') }}</strong></td></tr>
              <tr><td class="text-muted">Kategori</td><td>: <span class="badge badge-info">{{ $item->nama_kategori ?? 'Tanpa kategori' }}</span></td></tr>
              <tr><td class="text-muted">Stok</td><td>: {{ $item->stok }} unit</td></tr>
              <tr><td class="text-muted">Deskripsi</td><td>: {{ $item->deskripsi_produk ?? '-' }}</td></tr>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
    
@endforeach

<script>
  let halamanProduk = 
  Number(sessionStorage.getItem('halamanProduk')) || 1;
  const perHalamanProduk = 8;

  function tampilkanProduk() {
    const keyword = document.getElementById('inputCari').value.toLowerCase();
    const semuaBaris = Array.from(document.querySelectorAll('#tabelData tr'));

    // 1. Saring baris yang cocok dengan kata kunci pencarian
    const barisCocok = semuaBaris.filter(tr => tr.textContent.toLowerCase().includes(keyword));

    // 2. Hitung total halaman
    const totalHalaman = Math.ceil(barisCocok.length / perHalamanProduk) || 1;
    if (halamanProduk > totalHalaman) halamanProduk = totalHalaman;
    sessionStorage.setItem('halamanProduk', halamanProduk);

    // 3. semua baris disembunyikan terlebih dahulu
    semuaBaris.forEach(tr => tr.style.display = 'none');

    // 4. Tampilkan hanya baris sesuai halaman aktif
    const mulai = (halamanProduk - 1) * perHalamanProduk;
    const akhir = mulai + perHalamanProduk;
    barisCocok.slice(mulai, akhir).forEach(tr => tr.style.display = '');

    // 5. Update info halaman & status tombol
    document.getElementById('infoHalamanProduk').textContent = halamanProduk + ' / ' + totalHalaman;
    document.getElementById('btnPrevProduk').disabled = (halamanProduk <= 1);
    document.getElementById('btnNextProduk').disabled = (halamanProduk >= totalHalaman);
  }

  function filterTabel() {
    halamanProduk = 1;
    tampilkanProduk();
  }

  function gantiHalamanProduk(arah) {
    halamanProduk += arah;
    tampilkanProduk();
  }

  // Jalankan saat halaman pertama kali dibuka
  tampilkanProduk();
</script>

@endsection
