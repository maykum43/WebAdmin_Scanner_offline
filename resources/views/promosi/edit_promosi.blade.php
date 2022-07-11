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
                <h3 class="card-title">Edit Data Promosi</h3>
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="post" action="{{ route('promosi.update',$data->id_promosi) }}" enctype="multipart/form-data">
                    @csrf

                    @method('PATCH')
                    <div class="form-group mb-3 col-4">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" value="{{$data->judul}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Gambar Promosi</label>
                        <div class="input-group">
                        <img src="{{ URL::to('/')}}/storage/Promosi/{{$data->foto}}" class="img-thumbnail" width="200px">
                            <br>
                            <div class="custom-file col-6">
                                <input type="file" class="custom-file-input" id="foto" name="foto" value="{{$data->foto}}">
                                <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                            </div>
                        </div>
                    </div>
                    <!-- select -->
                    <div class="form-group" name="kategori" >
                        <label>Kategori</label>
                        <select class="form-control col-4" id="kategori" name="kategori">
                            <option>{{$data->kategori}}</option>
                            <option value="Content" id="Content">Content</option>
                            <option value="Slider" id="Slider">Slider</option>
                        </select>
                    </div>
                    <div class="form-group" name="status" >
                        <label>Status</label>
                        <select class="form-control col-4" id="opsi_status" name="status">
                            <option>{{$data->status}}</option>
                            <option value="Aktif" id="Aktif">Aktif</option>
                            <option value="Nonaktif" id="Nonaktif">Nonktif</option>
                        </select>
                    </div>
                    <div class="form-group" name="ket">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="ket"  @error('ket') is-invalid @enderror"
                        id="ket" value="{{ old('ket') }}" required autocomplete="ket" autofocus>{{$data->ket}}</textarea>
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
