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
                <h3 class="card-title">Data Serial Number</h3>
                <div class="btn-group float-right">
                    <a href="{{ route('import_sn') }}" class="btn btn-outline-info btn-sm float-right" data-toggle="modal"
                    data-target="#ModalExportData">
                        Import Excel
                    </a>
                    <a href="{{ route('create_sn') }}" class="btn btn-primary btn-sm float-right">
                        Tambah Data
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
            <form method="GET" action="{{ route('sn')}}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="cari_sn" placeholder="Masukan SN yang ingin dicari">
                            <div class="input-group-prepend">
                                <button class="btn btn-success" type="submit">Cari SN</button>
                            </div>
                            <!-- /btn-group -->

                        </div>
                    </form>
                <table class="table">
                    <thead>
                        <tr>
                            <button style="margin-bottom: 10px" class="btn btn-danger  delete_all" data-url="{{ url('DeleteAll') }}">Delete All Selected</button>
                            <th width="50px"><input type="checkbox" id="master"></th>
                            <th style="width: 10px">No</th>
                            <th>Serial Number </th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Discount (%)</th>
                            <th>Poin</th>
                            <th>Status</th>
                            <th style="width: 70px">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        // $english_format_number = number_format();
                        @endphp
                        @foreach($sn as $data)
                        <tr>
                            <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"></td>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->sn}}</td>
                            <td>{{ $data->model}}</td>
                            {{-- number_format($number, 2, '.', ''); --}}
                            <td>Rp. {{number_format($data->harga,2,',','.')}}</td>
                            <td>{{ $data->discount}}%</td>
                            <td>{{ $data->poin}}</td>
                            <td>{{ $data->status}}</td>
                            <td>
                                <div class="btn-group">
                                <a href="{{ route('edit_sn',$data->id)}}"
                                    class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('delete_sn',$data->id)}}"
                                    class="btn btn-warning btn-sm">Nonaktifkan</a>
                                <a href="{{ route('Hdelete_sn',$data->id)}}"
                                    class="btn btn-danger btn-sm">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>
                {{ $sn->links() }}
            </div>
            <!-- /.card-body -->
        </div>

    </div><!-- /.container-fluid -->

    <!-- Modal Import Data-->
    <div class="modal fade" id="ModalExportData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAddDataLabel">Import Excel Serial Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('import_sn') }}" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputFile">Import SN Produk</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="excel">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih file Excel</label>
                                </div>
                                {{-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Upload Data</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

</section>
<!-- /.content -->
</div>


@endsection
