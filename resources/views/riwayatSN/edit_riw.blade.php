@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Data Riwayat</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('update_riw',$data->id_rwsn)}}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label>SN</label>
                            <input type="text" name="sn" class="form-control" value="{{$data->sn}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Customer</label>
                            <input type="text" name="user" class="form-control" value="{{$data->id}}">
                        </div>
                      <!-- select -->
                      <div class="form-group" name="status">
                        <label>Status</label>
                        <select class="form-control" id="opsi_status" name="status">
                          <option value="Selesai" id="Selesai">Selesai</option>
                          <option value="Belum Selesai" id="Belum_selesai">Belum Selesai</option>
                        </select>
                      </div>
                <div class="form-group mb-4">
                    <button type="submit" class="btn btn-primary btn-mb-4">Simpan</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
