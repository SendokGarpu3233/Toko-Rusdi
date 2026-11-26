@extends('layouts.master')
@section('title', 'Sampah')

@section('konten')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Sampah</h2>
    <a href="/produk" class="btn btn-secondary btn-sm">Kembali ke Produk</a>
</div>

@if (session('pesan'))
    <div class="alert alert-success">{{ session('pesan') }}</div>
@endif

@php
    $tabAktif = session('tab', 'produk');
@endphp

<!-- Tab Navigasi: Produk & Kategori -->
<ul class="nav nav-tabs mb-3" id="sampahTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $tabAktif == 'produk' ? 'active' : '' }}" id="tab-produk" data-toggle="tab" href="#konten-produk" role="tab">
            Produk ({{ $data_sampah->count() }})
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $tabAktif == 'kategori' ? 'active' : '' }}" id="tab-kategori" data-toggle="tab" href="#konten-kategori" role="tab">
            Kategori ({{ $data_sampah_kategori->count() }})
        </a>
    </li>
</ul>

<div class="tab-content" id="sampahTabContent">
    <!-- TAB 1: SAMPAH PRODUK -->
    <div class="tab-pane fade {{ $tabAktif == 'produk' ? 'show active' : '' }}" id="konten-produk" role="tabpanel">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Dihapus Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_sampah as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_produk }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->deleted_at->format('d M Y, H:i') }}</td>
                                    <td class="text-nowrap" style="width: 1%;">
                                        <form action="/produk/{{ $item->id_produk }}/restore" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Pulihkan</button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#HapusPermanenProduk{{$item->id_produk}}">
                                            Hapus Permanen
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Sampah produk kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: SAMPAH KATEGORI -->
    <div class="tab-pane fade {{ $tabAktif == 'kategori' ? 'show active' : '' }}" id="konten-kategori" role="tabpanel">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Dihapus Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_sampah_kategori as $kat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kat->nama_kategori }}</td>
                                    <td>{{ $kat->deskripsi }}</td>
                                    <td>{{ $kat->deleted_at->format('d M Y, H:i') }}</td>
                                    <td class="text-nowrap" style="width: 1%;">
                                        <form action="/Kategori/{{ $kat->id_kategori }}/restore" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Pulihkan</button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#HapusPermanenKategori{{$kat->id_kategori}}">
                                            Hapus Permanen
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Sampah kategori kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Permanen Produk -->
@foreach ($data_sampah as $item)
<div class="modal fade" id="HapusPermanenProduk{{$item->id_produk}}" data-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/produk/{{ $item->id_produk }}/force-delete" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-danger">Hapus Permanen Produk</h5>
                <i class="far fa-fw fa-trash-alt text-danger"></i>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus permanen produk <strong>{{ $item->nama_produk }}</strong>? Data yang sudah dihapus secara permanen tidak bisa dikembalikan lagi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Iya, Hapus</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Modal Hapus Permanen Kategori -->
@foreach ($data_sampah_kategori as $kat)
<div class="modal fade" id="HapusPermanenKategori{{$kat->id_kategori}}" data-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/Kategori/{{ $kat->id_kategori }}/force-delete" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-danger">Hapus Permanen Kategori</h5>
                <i class="far fa-fw fa-trash-alt text-danger"></i>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus permanen kategori <strong>{{ $kat->nama_kategori }}</strong>? Produk yang memakai kategori ini akan berubah menjadi Tanpa kategori.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Iya, Hapus</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
