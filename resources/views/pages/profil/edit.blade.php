@extends('layouts.master')
@section('title', 'Edit Profil')
@section('konten')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Profil</h2>
    <a href="/produk" class="btn btn-secondary">
        <i class="fas fa-arrow-left mr-1"></i>Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Informasi Akun</h6>
    </div>
    <div class="card-body">
        <form action="/profil" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
            <!-- Kolom Kiri: Foto Profil & Live Preview -->
            <div class="col-md-4 text-center mb-4 mb-md-0 border-right">
                    <label class="form-label font-weight-bold d-block">Foto Profil</label>
                    <div class="my-3">
                        @if ($user?->foto)
                            <img id="previewFoto" src="{{ asset('uploads/' . $user->foto) }}" 
                                 class="rounded-circle shadow border" 
                                 style="width: 140px; height: 140px; object-fit: cover;" alt="Foto Profil">
                        @else
                            <img id="previewFoto" src="{{ asset('sbadmin/img/undraw_profile.svg') }}" 
                                 class="rounded-circle shadow border" 
                                 style="width: 140px; height: 140px; object-fit: cover;" alt="Foto Profil">
                        @endif
                    </div>
                    <h6 class="font-weight-bold text-dark mb-1">{{ $user?->name }}</h6>
                    <span class="badge badge-primary mb-2">{{ $user?->role== 'super_admin' ? 'Super Admin' : 'Admin' }}</span>
                    <div class="small text-muted mb-3">Bergabung: {{ $user->created_at?->format('d M Y') }}</div>
                    <div class="mt-2" style="max-width: 260px; margin: 0 auto;">
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('inputFoto').click()">
                            <i class="fas fa-camera mr-1"></i> Unggah Foto Baru
                        </button>
                        <input type="file" name="foto" class="d-none" id="inputFoto" accept="image/*" onchange="previewImage()">
                        <small class="text-muted d-block mt-2">Format: JPG, PNG, WEBP (Maks: 5MB)</small>
                    </div>
                    @error('foto')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Kolom Kanan: Form Data User -->
                <div class="col-md-8 pl-md-4">
                    <!-- Nama Lengkap -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $user?->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $user?->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    
                    <!-- Password Baru (Opsional) -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Password Baru</label>
                        <div class="input-group">
                            <input type="password" name="password" id="inputPass" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin mengganti password">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePass('inputPass', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <small class="text-muted d-block mt-1">Minimal 6 karakter jika ingin diubah.</small>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="inputPassConfirm" class="form-control" placeholder="Ketik ulang password baru">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePass('inputPassConfirm', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Script Live Preview Foto Profil --}}
<script>
    function previewImage() {
        const input = document.getElementById('inputFoto');
        const preview = document.getElementById('previewFoto');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function togglePass(idInput, btn) {
        const input = document.getElementById(idInput);
        const icon  = btn.querySelector('i');
        input.type  = (input.type === 'password') ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }
</script>
@endsection


