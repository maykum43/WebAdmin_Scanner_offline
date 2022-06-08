@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Serial Number Aktif</h3>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th>Serial Number </th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Discount (%)</th>
                            <th>Poin</th>
                            <!-- <th style="width: 70px">Action
                            </th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach ($sn as $data)
                        <tr class="odd">
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->sn}}</td>
                            <td>{{ $data->model}}</td>
                            <td>Rp. {{ $data->harga}}</td>
                            <td>{{ $data->discount}}</td>
                            <td>{{ $data->poin}}</td>
                            <!-- <td>{{ $data->status}}</td> -->
                            <!-- <td>
                                    <div class="btn-group">
                                        <a href="" 
                                            class="btn btn-success btn-sm">Detail</a>
                                        <a href="{{ route('edit_sn',$data->id)}}" 
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="" 
                                            class="btn btn-danger btn-sm">Hapus</a>
                                    </div>
                                </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>
                {{ $sn->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
