@extends('layouts.master')
@section('title', 'Dashboard')

@section('konten')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Dashboard Toko</h2>
</div>

<!-- 1. Kartu Ringkasan Angka -->
<div class="card mb-4">
    <div class="card-body py-3">
        <div class="row">
            <div class="col-md-4 mb-3 mb-mb-0 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Total Produk</small>
                    <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalProduk }} Produk</div>
                </div>
                <i class="fas fa-box fa-2x text-dark-300"></i>
            </div>
            <div class="col-md-4 mb-3 mb-mb-0 border-left d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Total Kategori</small>
                    <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalKategori }} Kategori</div>
                </div>
                <i class="fas fa-tags fa-2x text-dark-300"></i>
            </div>
            <div class="col-md-4 border-left d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Total Stok</small>
                    <div class="h4 mb-0 font-weight-bold text-dark">{{ $totalStok }} Unit</div>
                </div>
                <i class="fas fa-cubes fa-2x text-dark-300"></i>
            </div>
        </div>
    </div>
</div>

<!-- 2. Baris Grafik: Kiri (Batang) & Kanan (Donat) -->
<div class="row">
    <!-- Grafik Batang Stok per Produk -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Total Stok per Kategori</h6>
            </div>
            <div class="card-body">
                <div style="height: 320px;">
                    <canvas id="grafikStok"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Produk per Kategori -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Produk per Kategori</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse ($produkPerKategori as $kat)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 item-kategori" data-id="{{ $kat->id_kategori }}">
                            <span>{{ $kat->nama_kategori }}</span>
                            <span class="font-weight-bold text-gray-800">{{ $kat->total }} produk</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted px-0">Belum ada kategori</li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2">
                <button type="button" id="btnPrevKat" class="btn btn-sm btn-outline-secondary" onclick="gantiHalamanKat(-1)">&lsaquo; Prev</button>
                <small class="text-muted" id="infoHalamanKat">1 / 1</small>
                <button type="button" id="btnNextKat" class="btn btn-sm btn-outline-secondary" onclick="gantiHalamanKat(1)">Next &rsaquo;</button>
            </div>
        </div>
    </div>
</div>

<!-- 3. Daftar Stok Menipis -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Stok Menipis</h6>
    </div>
    <div class="card-body">
        @if ($stokMenipis->isEmpty())
            <p class="text-muted mb-0">Tidak ada produk dengan stok menipis.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th style="width: 120px;">Stok</th>
                            <th style="width: 90px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stokMenipis as $item)
                            <tr>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        @if ($item->gambar)
                                            <img src="{{ asset('uploads/' . $item->gambar) }}" class="rounded border mr-2" style="width: 40px; height: 40px; object-fit: cover; flex-shrink: 0;">
                                        @else
                                            <div class="rounded border bg-light d-flex align-items-center justify-content-center text-muted mr-2" style="width: 40px; height: 40px; flex-shrink: 0;">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-weight-bold text-dark">{{ $item->nama_produk }}</div>
                                            <small class="text-muted">{{ $item->kode_produk }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-danger font-weight-bold">{{ $item->stok }} unit</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Restok{{$item->id_produk}}">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>


<!-- Modal Restok Cepat -->
@foreach ($stokMenipis as $item)
<div class="modal fade" id="Restok{{$item->id_produk}}" data_backdrop="static" tabindex="-1" aria-hidden="true">       
    <div class="modal-dialog modal-sm">
        <form action="/produk/{{ $item->id_produk }}" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <input type="hidden" name="nama_produk" value="{{ $item->nama_produk }}" >
        <input type="hidden" name="harga" value="{{ $item->harga }}">
        <input type="hidden" name="kategori" value="{{ $item->kategori_id }}">
        <input type="hidden" name="deskripsi_produk" value="{{ $item->deskripsi_produk }}">
        <div class="modal-header">
           <h5 class="modal-title font-weight-bold text-primary">Update Stok</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p class="small text-muted mb-2">{{$item->nama_produk}}</p>
            <label>Jumlah Stok Baru <span class="text-danger">*</span></label>
            <input type="number" name="stok" min="0" class="form-control" value="{{$item->stok}}" required>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </div>
        </form>
    </div>
</div>
@endforeach








<!-- 4. Library & Script Chart.js -->
<script src="{{ asset('sbadmin/vendor/chart.js/Chart.min.js') }}"></script>
<script>
    // Data semua produk dari Controller (untuk disaring mengikuti halaman kategori)
    const semuaProduk = @json($semuaProduk);

    // Palet 5 warna tenang (tanpa merah agar tidak bentrok dengan tabel Stok Menipis)
    const paletWarna = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#858796'];

    // Inisialisasi Grafik Donat (Total Stok per Kategori)
    const ctx = document.getElementById('grafikStok').getContext('2d');
    const grafikStok = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [],
            datasets: [{
                data: [],
                backgroundColor: paletWarna,
                hoverBorderColor: 'rgba(234, 236, 244, 1)',
                borderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutoutPercentage: 65,
            legend: {
                position: 'bottom'
            }
        }
    });

    // Pagination Kategori (5 kategori per halaman) + Sinkronisasi Grafik Donat
    let halamanKat = 1;
    const perHalamanKat = 5;

    function tampilkanKategori() {
        const items = document.querySelectorAll('.item-kategori');
        const totalHalaman = Math.ceil(items.length / perHalamanKat) || 1;
        const labelsBaru = [];
        const stokBaru   = [];

        items.forEach((item, index) => {
            const mulai = (halamanKat - 1) * perHalamanKat;
            const akhir = mulai + perHalamanKat;
            const tampil = index >= mulai && index < akhir;

            item.style.setProperty('display', tampil ? 'flex' : 'none', 'important');

            if (tampil) {
                const idKat   = Number(item.dataset.id);
                const namaKat = item.querySelector('span').textContent.trim();

                // Jumlahkan total stok semua produk di kategori ini
                const totalStokKat = semuaProduk
                    .filter(p => Number(p.kategori_id) === idKat)
                    .reduce((total, p) => total + Number(p.stok), 0);

                labelsBaru.push(namaKat);
                stokBaru.push(totalStokKat);
            }
        });

        // Perbarui Grafik Donat secara mulus tanpa reload halaman
        grafikStok.data.labels = labelsBaru;
        grafikStok.data.datasets[0].data = stokBaru;
        grafikStok.update();

        // Update tombol & info halaman
        document.getElementById('infoHalamanKat').textContent = halamanKat + ' / ' + totalHalaman;
        document.getElementById('btnPrevKat').disabled = (halamanKat <= 1);
        document.getElementById('btnNextKat').disabled = (halamanKat >= totalHalaman);
    }

    function gantiHalamanKat(arah) {
        halamanKat += arah;
        tampilkanKategori();
    }

    // Jalankan pertama kali saat halaman dibuka
    tampilkanKategori();
</script>
@endsection
