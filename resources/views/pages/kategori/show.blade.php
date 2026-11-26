@extends('layouts.master')
@section('konten')
    

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Kategori</h1>
    <a href="/Kategori/create" class="btn btn-primary mb-3">Tambah kategori</a>
</div>


<hr>

<div class="card">
    <div class=" card-header">
        <div style="max-width: 300px; width: 100%;">
        <input type="text" id="inputCari" onkeyup="filterTabel()" class="form-control" placeholder="Ketik untuk mencari data..">

      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Kategori</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody id="tabelData">
    @forelse ($kategori as $item)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$item->nama_kategori}}</td>
      <td>{{$item->deskripsi}}</td>
      <td class="text-nowrap" style="width: 1%;">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#DetailKat{{$item->id_kategori}}">Detail</button>
        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Editkat{{$item->id_kategori}}">Edit</button>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Hapus{{$item->id_kategori}}">
            Hapus
        </button>
      </td>
    </tr>
    @empty
        <tr>
            <td colspan="4"  class="text-center">Data Kosong</td>     
        </tr>
    @endforelse
  </tbody>
</table>
  </div>
    </div>
</div>

<!-- Modal -->
@foreach ($kategori as $item)

<div class="modal fade" id="Hapus{{$item->id_kategori}}" data-backdrop='static' aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action='/Kategori/{{$item->id_kategori}}' method='POST' class="modal-content">
      @csrf
      @method('delete')
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
        <i class="far fa-fw fa-trash-alt"></i>
      </div>
      <div class="modal-body">
      Apakah anda yakin ingin menghapus Kategori <strong style="font-weight: 900 !important;">{{$item->nama_kategori}}</strong> ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-danger">Iya</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Detail Kategori -->
<div class="modal fade" id="DetailKat{{$item->id_kategori}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold text-primary">Detail Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless table-sm mb-0">
          <tr><td class="text-muted" style="width: 130px;">ID Kategori</td><td>: #{{ $item->id_kategori }}</td></tr>
          <tr><td class="text-muted">Nama Kategori</td><td>: <strong>{{ $item->nama_kategori }}</strong></td></tr>
          <tr><td class="text-muted">Deskripsi</td><td>: {{ $item->deskripsi ?? '-' }}</td></tr>
          <tr><td class="text-muted">Dibuat Pada</td><td>: {{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</td></tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit Kategori -->
<div class="modal fade" id="Editkat{{$item->id_kategori}}" data-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/Kategori/{{$item->id_kategori}}" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold text-primary">Edit kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Kategori <span class="text-danger">*</span></label>
          <input type="text" name="nama_kategori" class="form-control" value="{{$item->nama_kategori}}" required>
        </div>
        <div class="mb-0">
          <label>Deskripsi <span class="text-danger">*</span></label>
          <textarea name="deskripsi" class="form-control" rows="3" required>{{$item->deskripsi}}</textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

    
@endforeach

<script>
  function filterTabel() {
    const keyword = document.getElementById('inputCari').value.toLowerCase();
    const baris = document.querySelectorAll('#tabelData tr');

    baris.forEach(function(tr) {
      const teksBaris = tr.textContent.toLowerCase();
      if (teksBaris.includes(keyword)) {
        tr.style.display = '';
      } else {
        tr.style.display = 'none';
      }
    });
  }
</script>




@endsection