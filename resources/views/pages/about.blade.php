@extends('layouts.master')
@section('title', 'Tentang Kami')

@section('konten')
<!-- Judul Halaman -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tentang Kami</h2>
</div>

<!-- Card Utama: Profil Toko -->
<div class="card shadow mb-4">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <!-- Kolom Teks (Kiri) -->
            <div class="col-md-8">
                <h4 class="font-weight-bold text-primary mb-3">Selamat Datang di Toko Rusdi!</h4>
                <p class="text-muted leading-relaxed">
                    Kami adalah pusat belanja terpercaya yang menyediakan berbagai macam kebutuhan Anda, 
                    mulai dari produk elektronik, pakaian, kecantikan, peralatan rumah tangga, otomotif, 
                    hingga komputer dan laptop berkualitas dengan harga yang terjangkau.
                </p>
                <a href="/produk" class="btn btn-primary">
                    <i class="fas fa-box-open mr-1"></i> Jelajahi Produk Kami
                </a>
            </div>

            <!-- Kolom Icon Toko Besar (Kanan) -->
            <div class="col-md-4 text-center d-none d-md-block">
                <i class="fas fa-store fa-7x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>

<!-- 3 Kotak Keunggulan Toko -->
<div class="row">
    <!-- Keunggulan 1: Produk Lengkap -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="font-weight-bold text-primary mb-1">
                    <i class="fas fa-boxes mr-1"></i> Produk Lengkap
                </div>
                <div class="text-muted small">Menyediakan berbagai kategori produk pilihan dari harian hingga elektronik.</div>
            </div>
        </div>
    </div>

    <!-- Keunggulan 2: Harga Terjangkau -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="font-weight-bold text-success mb-1">
                    <i class="fas fa-tags mr-1"></i> Harga Terjangkau
                </div>
                <div class="text-muted small">Penawaran harga terbaik dan kompetitif untuk semua pelanggan setia kami.</div>
            </div>
        </div>
    </div>

    <!-- Keunggulan 3: Layanan Cepat -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="font-weight-bold text-info mb-1">
                    <i class="fas fa-shipping-fast mr-1"></i> Layanan Cepat
                </div>
                <div class="text-muted small">Kemudahan transaksi dan respon cepat untuk kenyamanan belanja Anda.</div>
            </div>
        </div>
    </div>
</div>
@endsection
