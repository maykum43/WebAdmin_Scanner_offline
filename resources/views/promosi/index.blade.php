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
                <h3 class="card-title">Data Content</h3>
                <a href="{{ route('promosi.create') }}" class="btn btn-primary btn-sm float-right">
                    Tambah Data
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                
                <form method="GET" action="{{ route('promosi.index')}}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari_promosi" placeholder="Masukan Judul Promosi">
                        <div class="input-group-prepend">
                            <button class="btn btn-success" type="submit">Cari Promosi</button>
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
                            <th>Gambar </th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Created at</th></th>
                            <th>Kategori</th>
                            <th style="width: 120px">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach ($promosis as $data)
                        <tr class="odd">
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->judul}}</td>
                            <!-- <td><img src="storage/Hadiah/FotoHadiah/{{$data->foto}}" width="50px"></td>  -->
                            <td><img src="{{ URL::to('/')}}/storage/Promosi/{{$data->foto}}" class="img-thumbnail" width="65px"></td>
                            <!-- <td>{{$data->foto}}</td> -->
                            <td>{{ $data->status}}</td>
                            <td>{{ $data->created_at}}</td>
                            <td>{{ $data->kategori}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="" 
                                        class="btn btn-primary btn-sm">Push Notif</a>
                                    <a href="{{ route('promosi.edit',$data->id_promosi)}}" 
                                        class="btn btn-warning btn-sm">Edit</a>
                                    {{-- {{ route('Hdelete_user',$data->id_promosi)}} --}}
                                    <a href="{{ route('promosi.nonaktif',$data->id_promosi)}}"
                                        class="btn btn-danger btn-sm">Non Aktif</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>
                    {{ $promosis->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
