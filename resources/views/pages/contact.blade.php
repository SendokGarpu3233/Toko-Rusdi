@extends('layouts.master')
@section('konten')


<div class="row">
    <!-- Kolom Kiri: Biodata -->
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-primary text-white py-3">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-user me-2"></i> Tentang Saya</h6>
            </div>
            <div class="card-body">
                <h5 class="card-title fw-bold text-dark mb-3">Biodata Pengembang</h5>
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <td class="text-muted" style="width: 90px;">Nama</td>
                        <td style="width: 15px;">:</td>
                        <td class="fw-semibold text-dark">Dimas</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Alamat</td>
                        <td>:</td>
                        <td class="fw-semibold text-dark">Kurnia</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Agama</td>
                        <td>:</td>
                        <td class="fw-semibold text-dark">Islam</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>:</td>
                        <td class="fw-semibold text-dark">Mahasiswa</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Kontak & Sosial Media -->
    <div class="col-md-7 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-book me-2"></i> Hubungi Saya</h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
                <p class="text-muted">
                    Jika ada pertanyaan seputar pengelolaan produk pada sistem <strong>Toko Rusdi</strong>, silakan hubungi melalui kontak berikut:
                </p>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <a href="https://wa.me/6289693793233" target="_blank" class="btn btn-success btn-sm">
                        <i class="fab fa-whatsapp me-1"></i> WhatsApp
                    </a>
                    <a href="https://www.instagram.com/dimas.alfiardi/" target="_blank" class="btn btn-danger btn-sm">
                        <i class="fab fa-instagram me-1"></i> Instagram
                    </a>
                    <a href="mailto:dimas.alpiardi@gmail.com" class="btn btn-primary btn-sm">
                        <i class="fas fa-envelope me-1"></i> Email
                    </a>
                </div>
                <div class="alert alert-primary mb-0 py-2">
                    Pergi dan lihat profil lengkap saya: 
                    <a href="https://www.instagram.com/dimas.alfiardi/" class="fw-bold text-primary text-decoration-underline">klik di sini untuk melihat saya</a> dan ikuti saya.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection