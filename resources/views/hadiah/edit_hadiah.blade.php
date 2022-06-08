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
                <h3 class="card-title">Edit Data Hadiah</h3>
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="post" action="{{ route('hadiah.update',$data->id) }}" enctype="multipart/form-data">
                    @csrf

                    @method('PATCH')
                    <div class="form-group mb-3 col-4">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{$data->name}}">
                    </div>
                    <div class="form-group mb-3 col-4">
                        <label>Request Poin</label>
                        <input type="number" name="req_poin" class="form-control" value="{{$data->req_poin}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Gambar Hadiah</label>
                        <div class="input-group">
                        <img src="{{ URL::to('/')}}/storage/Hadiah/FotoHadiah/{{$data->foto}}" class="img-thumbnail" width="200px">
                            <br>
                            <div class="custom-file col-6">
                                <input type="file" class="custom-file-input" id="foto" name="foto" value="{{$data->foto}}">
                                <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                            </div>
                        </div>
                    </div>
                    <!-- select -->
                    <div class="form-group" name="status" >
                        <label>Status</label>
                        <select class="form-control col-4" id="opsi_status" name="status">
                            <option>{{$data->status}}</option>
                            <option value="Aktif" id="Aktif">Aktif</option>
                            <option value="Nonaktif" id="Nonaktif">Nonktif</option>
                        </select>
                    </div>
                    <div class="form-group mb-3 col-4">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{$data->stok}}">
                    </div>
                    <div class="form-group mb-4">
                        <button type="submit" class="btn btn-primary btn-mb-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
