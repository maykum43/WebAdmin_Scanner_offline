@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Riwayat Redeem SN</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!--  -->
                    <form action="{{ route('simpan_riw')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>SN</label>
                            <select class="form-control select2 select2-danger select2-hidden-accessible"
                                data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12"
                                tabindex="-1" aria-hidden="true" name="sn">
                                <option value="">Pilih SN</option>
                                @foreach ($data_sn as $item)
                                <option value="{{$item->sn}}">{{$item->sn." - ".$item->judul}}</option>
                                @endforeach
                            </select>
                            <!-- <label>Reward</label>
                            <select class="form-control select2 select2-danger select2-hidden-accessible"
                                data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12"
                                tabindex="-1" aria-hidden="true" name="judul">
                                <option value="">Pilih SN</option>
                                @foreach ($data_sn as $item)
                                <option value="{{$item->sn}}">{{$item->judul}}</option>
                                @endforeach
                            </select> -->
                        </div>

                        <div class="form-group">
                            <label>User</label>
                            <select class="form-control select2 select2-danger select2-hidden-accessible"
                                data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12"
                                tabindex="-1" aria-hidden="true" name="user">
                                <option value="">Pilih User</option>
                                @foreach ($data_user as $item)
                                <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
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
