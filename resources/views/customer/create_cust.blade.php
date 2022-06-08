@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Customer</h3>
            </div>
            <div class="card-body">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('simpan_us')}}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            value="{{ old('password') }}" required autofocus>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label>No. Telepon</label>
                        <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label>Alamat Lengkap</label>
                        <textarea rows="3" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            id="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>No. Rekening</label>
                        <input type="number" name="norek" class="form-control @error('norek') is-invalid @enderror"
                            id="norek" value="{{ old('norek') }}" required autocomplete="norek" autofocus>
                    </div>
                    <div class="form-group" name="nama_bank">
                        <label>Nama Bank</label>
                        <select class="form-control" id="opsi_status" name="nama_bank">
                            <option value="BCA" id="Aktif">BCA</option>
                            <option value="Mandiri" id="Aktif">Mandiri</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Pemilik Rekening</label>
                        <input type="text" name="atas_nama"
                            class="form-control @error('atas_nama') is-invalid @enderror" id="atas_nama"
                            value="{{ old('atas_nama') }}" required autocomplete="atas_nama" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label>Username Akun Online Shop</label>
                        <input type="text" name="nama_akun_ol"
                            class="form-control @error('nama_akun_ol') is-invalid @enderror" id="harga"
                            value="{{ old('nama_akun_ol') }}" required autofocus>
                    </div>
                    <!-- select -->
                    <!-- <div class="form-group" name="status">
                        <label>Status</label>
                        <select class="form-control" id="opsi_status" name="status">
                            <option value="Aktif" id="Aktif">Aktif</option>
                            <option value="Nonaktif" id="Nonaktif">Nonktif</option>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="exampleInputFile">Foto User</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                                <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                            </div>
                            <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <button type="submit" class="btn btn-primary btn-mb-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
