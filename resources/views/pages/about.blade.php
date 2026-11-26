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

<!-- Kategori Produk Tersedia (Dinamis dari Database + Berjalan Menyamping) -->
<style>
    .marquee-wrapper {
        overflow: hidden;
        position: relative;
        width: 100%;
    }
    .marquee-track {
        display: flex;
        width: max-content;
        animation: jalanMenyamping 22s linear infinite;
    }
    .marquee-wrapper:hover .marquee-track {
        animation-play-state: paused;
    }
    .marquee-item {
        width: 170px;
        flex-shrink: 0;
        margin-right: 12px;
    }
    @keyframes jalanMenyamping {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
</style>

@php
    $pilihIcon = function ($nama) {
        $n = strtolower($nama);
        if (str_contains($n, 'hp') || str_contains($n, 'phone')) return 'fas fa-mobile-alt';
        if (str_contains($n, 'tv')) return 'fas fa-tv';
        if (str_contains($n, 'printer')) return 'fas fa-print';
        if (str_contains($n, 'jam') || str_contains($n, 'watch')) return 'fas fa-clock';
        if (str_contains($n, 'ac')) return 'fas fa-snowflake';
        if (str_contains($n, 'laptop') || str_contains($n, 'komputer')) return 'fas fa-laptop';
        if (str_contains($n, 'monitor') || str_contains($n, 'display')) return 'fas fa-desktop';
        if (str_contains($n, 'aksesoris') || str_contains($n, 'keyboard')) return 'fas fa-keyboard';
        if (str_contains($n, 'audio') || str_contains($n, 'sound')) return 'fas fa-headphones';
        if (str_contains($n, 'penyimpanan') || str_contains($n, 'storage')) return 'fas fa-hdd';
        return 'fas fa-box';
    };
@endphp

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Kategori Produk Tersedia</h6>
        <a href="/Kategori" class="small font-weight-bold">Lihat Semua &rarr;</a>
    </div>
    <div class="card-body">
        @if ($kategori->isEmpty())
            <div class="text-center text-muted small">Belum ada kategori.</div>
        @else
            <div class="marquee-wrapper">
                <div class="marquee-track">
                    {{-- Diulang 2x agar perputarannya mulus tanpa putus --}}
                    @for ($loopCopy = 0; $loopCopy < 2; $loopCopy++)
                        @foreach ($kategori as $kat)
                            <div class="marquee-item">
                                <div class="p-3 border rounded bg-light text-center h-100">
                                    <i class="{{ $pilihIcon($kat->nama_kategori) }} fa-lg text-primary mb-2"></i>
                                    <div class="font-weight-bold text-dark small text-truncate">{{ $kat->nama_kategori }}</div>
                                    <small class="text-muted">{{ $kat->total }} Produk</small>
                                </div>
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
