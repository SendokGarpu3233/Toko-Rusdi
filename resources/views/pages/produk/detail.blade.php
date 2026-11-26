@extends('layouts.master')
@section('title', 'Detail Produk')

@section('konten')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Produk</h2>
    <div>
        <a href="/produk" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        <a href="/produk/{{ $produk->id_produk }}/edit" class="btn btn-warning">
            <i class="fas fa-edit mr-1"></i> Edit Produk
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Informasi Produk</h6>
    </div>
    <div class="card-body">
        <div class="row align-items-center">
            
            <!-- Kolom Kiri: Foto Produk -->
            <div class="col-md-4 text-center mb-3 mb-md-0">
                @if ($produk->gambar)
                    <img src="{{ asset('uploads/' . $produk->gambar) }}" 
                         class="img-thumbnail shadow-sm rounded" 
                         style="max-width: 100%; max-height: 280px; object-fit: cover;" 
                         alt="{{ $produk->nama_produk }}">
                @else
                    <div class="alert alert-secondary py-4">
                        <i class="fas fa-image fa-3x text-muted mb-2 d-block"></i>
                        <span class="small font-weight-bold">Belum ada gambar untuk produk ini</span>
                    </div>
                @endif
            </div>

            <!-- Kolom Kanan: Rincian Produk -->
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-muted font-weight-bold" style="width: 170px;">Kode Produk</td>
                            <td>: <span class="badge badge-secondary">{{ $produk->kode_produk }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Nama Produk</td>
                            <td>: <strong class="h5 text-dark font-weight-bold">{{ $produk->nama_produk }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Harga</td>
                            <td>: <span class="text-success font-weight-bold h5">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Stok Tersedia</td>
                            <td>: <span class="badge badge-info">{{ $produk->stok }} unit</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Kategori</td>
                            <td>: <span class="badge badge-info">{{ $produk->kategori->nama_kategori ?? 'Tanpa kategori' }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Deskripsi Produk</td>
                            <td>: {{ $produk->deskripsi_produk ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection