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
                <h3 class="card-title">Data Riwayat Scanner Serial Number</h3>
                <!-- <a href="{{ route('create_riw')}}" class="btn btn-primary btn-sm float-right">
                    Tambah Data
                </a> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="GET" action="{{ route('rwtsn')}}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari"
                            placeholder="Masukan User yang ingin dicari">
                        <div class="input-group-prepend">
                            <button class="btn btn-success" type="submit">Cari SN</button>
                        </div>
                        <!-- /btn-group -->

                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th>Serial Number</th>
                            <th>Nama Produk</th>
                            <th>Nama Customer</th>
                            <th>Poin</th>
                            <th>Tanggal Scaning</th>
                            <th style="width: 70px">Action 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach ($riw as $data)
                        <tr class="odd">
                            <td>{{ $i++ }}</td>
                            <td>{{ $data['sn']}}</td>
                            <td>{{ $data['model']}}</td>
                            <td>{{ $data['email']}}</td>
                            <td>{{ $data['poin']}}</td>
                            <td>{{ $data['created_at']}}</td>
                            <td>
                                <div class="btn-group">
                                    {{-- <a href="{{ route('edit_riw',$data->id_rwt)}}"
                                        class="btn btn-warning btn-sm">Detail</a> --}}
                                    <a href="{{ route('delete_riw',$data->id_rwt)}}" 
                                            class="btn btn-danger btn-sm">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $riw->links() }}
            </div>
        </div>
    </div>
    @endsection
