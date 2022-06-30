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
            <div class="card-body">
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
                            {{-- <td>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="statusSwitch">
                                        <label class="custom-control-label" for="statusSwitch">{{ $data->status}}</label>
                                    </div>
                                </div>
                            </td> --}}
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('Approve',$data->id)}}" class="btn btn-success btn-sm">Setujui</a>
                                    <a href="{{ route('edit_user',$data->id)}}"
                                        class="btn btn-warning btn-sm">Detail</a>
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
    <script>
        $(function() {
          $('.custom-control-input').change(function() {
              var status = $(this).prop('Disetujui') == true ? 1 : 0; 
              var id = $(this).data('id'); 
               
              $.ajax({
                  type: "GET",
                  dataType: "json",
                  url: '/Approve',
                  data: {'status': status, 'id': id},
                  success: function(data){
                    console.log(data.success)
                  }
              });
          })
        })
      </script>
</section>
@endsection
