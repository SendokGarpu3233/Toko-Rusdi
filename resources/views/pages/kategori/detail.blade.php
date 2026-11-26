@extends('layouts.master')
@section('title', 'Detail Kategori')

@section('konten')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detail Kategori</h2>
    <div>
        <a href="/Kategori" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        <a href="/Kategori/{{ $kategori->id_kategori }}/edit" class="btn btn-warning">
            <i class="fas fa-edit mr-1"></i> Edit Kategori
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Informasi Kategori</h6>
    </div>
    <div class="card-body">
        <div class="row align-items-center">
            <!-- Icon Ilustrasi Kategori (Pengganti Foto) -->
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle shadow-sm" style="width: 140px; height: 140px;">
                    <i class="fas fa-layer-group fa-4x text-primary"></i>
                </div>
            </div>

            <!-- Rincian Data Kategori -->
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-muted font-weight-bold" style="width: 180px;">ID Kategori</td>
                            <td>: <span class="badge badge-secondary">#{{ $kategori->id_kategori }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Nama Kategori</td>
                            <td>: <strong class="h5 text-dark font-weight-bold">{{ $kategori->nama_kategori }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Deskripsi</td>
                            <td>: {{ $kategori->deskripsi ?? 'Tidak ada deskripsi.' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Dibuat Pada</td>
                            <td>: {{ $kategori->created_at ? $kategori->created_at->format('d F Y, H:i') : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted font-weight-bold">Terakhir Diperbarui</td>
                            <td>: {{ $kategori->updated_at ? $kategori->updated_at->diffForHumans() : '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection