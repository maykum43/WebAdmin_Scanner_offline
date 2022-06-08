@extends('layouts.app')
@section('content')

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
                <h3 class="card-title">Data Riwayat Redeem Poin Customer</h3>
                {{-- <a href="" class="btn btn-primary btn-sm float-right">
                    Tambah Data
                </a> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                {{-- {{ route('hadiah.index')}} --}}
                <form method="GET" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari_hadiah" placeholder="Masukan Nama Customer">
                        <div class="input-group-prepend">
                            <button class="btn btn-success" type="submit">Cari Customer</button>
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
                            <th>Nama Customer </th>
                            <th>Nama Hadiah</th>
                            <th>Jumlah Poin</th>
                            <th>Tanggal Redeem</th>
                            <th>Status</th>
                            <th style="width: 70px">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach ($data_redeem as $data)
                        <tr class="odd">
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->email}}</td>
                            <td>{{ $data->nama_hadiah}}</td>
                            <td>{{$data->jml_poin}}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->status}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('done_riw',$data->id)}}" 
                                        class="btn btn-info btn-sm">Selesai</a>
                                    <a href="{{ route('delete_red',$data->id)}}"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>
                    {{ $data_redeem->links() }}
            </div>
        </div>
    </div>
</section>
    
@endsection