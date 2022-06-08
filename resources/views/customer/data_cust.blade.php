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
                <h3 class="card-title">Data Customer</h3>
                <a href="{{ route('create_us') }}" class="btn btn-primary btn-sm float-right">
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

                <form method="GET" action="{{ route('customer')}}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari_user" placeholder="Masukan Nama Customer">
                        <div class="input-group-prepend">
                            <button class="btn btn-success" type="submit">Cari User</button>
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
                            <th>Email </th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th style="width: 70px">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach ($cust as $data)
                        <tr class="odd">
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->email}}</td>
                            <td>{{ $data->name}}</td>
                            <td>{{ $data->phone}}</td>
                            <td>{{ $data->status}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('edit_user',$data->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('Hdelete_user',$data->id)}}"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>
                    {{ $cust->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
