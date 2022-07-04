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
                <h3 class="card-title">Edit Data Customer</h3>
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('update_user',$data->id) }}" method="POST">
                    @csrf

                    <div class="form-group mb-3 col-4">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{$data->name}}">
                    </div>
                    <div class="form-group mb-3 col-6">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{$data->email}}">
                    </div>
                    <div class="form-group mb-3 col-3">
                        <label>Telepon</label>
                        <input type="number" name="phone" class="form-control" value="{{$data->phone}}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Alamat Lengkap</label>
                        <textarea name ="alamat" class="form-control" rows="3" >{{$data->alamat}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>No. Rekening</label>
                        <input type="number" name="norek" class="form-control" value="{{$data->norek}}">
                    </div>
                    <div class="form-group" name="nama_bank">
                        <label>Nama Bank</label>
                        <select class="form-control" id="opsi_status" name="nama_bank" value = "{{$data->nama_bank}}">
                            <option value="BCA" {{$data->nama_bank == "BCA" ? 'selected' : ''}}>BCA</option>
                            <option value="Mandiri" {{$data->nama_bank == "Mandiri" ? 'selected' : ''}}>Mandiri</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Atas Nama</label>
                        <input type="text" name="atas_nama" class="form-control" value="{{$data->atas_nama}}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Username Akun Online Shop</label>
                        <input type="text" name="nama_akun_ol" class="form-control" value="{{$data->nama_akun_ol}}">
                    </div>
                    <!-- select -->
                    <div class="form-group" name="status">
                        <label>Status</label>
                        <select class="form-control" id="opsi_status" name="status">
                            <option>{{$data->status}}</option>
                            <option value="Aktif" id="Aktif">Aktif</option>
                            <option value="Nonaktif" id="Nonaktif">Nonktif</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>FCM</label>
                        <textarea name ="alamat" class="form-control" rows="3" >{{$data->fcm}}</textarea>
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
