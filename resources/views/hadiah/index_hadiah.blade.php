@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Hadiah</h3>
                <a href="{{ route('hadiah.create') }}" class="btn btn-primary btn-sm float-right">
                    Tambah Data
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                
                <form method="GET" action="{{ route('hadiah.index')}}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari_hadiah" placeholder="Masukan Nama Hadiah">
                        <div class="input-group-prepend">
                            <button class="btn btn-success" type="submit">Cari Hadiah</button>
                        </div>
                        <!-- /btn-group -->

                    </div>
                </form>

                <!-- <a href="" class="btn btn-sm btn-primary float-end">Tambah Data</a> -->
                <!-- <p> -->

                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th>Nama </th>
                            <th>Req Poin</th>
                            <th>Foto</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th style="width: 70px">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach ($hadiahs as $data)
                        <tr class="odd">
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->name}}</td>
                            <td>{{number_format($data->req_poin,0,',','.')}} Poin</td>
                            <!-- <td><img src="storage/Hadiah/FotoHadiah/{{$data->foto}}" width="50px"></td>  -->
                            <td><img src="{{ URL::to('/')}}/storage/Hadiah/FotoHadiah/{{$data->foto}}" class="img-thumbnail" width="65px"></td>
                            <!-- <td>{{$data->foto}}</td> -->
                            <td>{{ $data->stok}}</td>
                            <td>{{ $data->status}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('hadiah.edit',$data->id)}}" 
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <!-- {{ route('Hdelete_user',$data->id)}} -->
                                    <a href="{{ route('Hdelete_hadiah',$data->id)}}"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>
                    {{ $hadiahs->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
