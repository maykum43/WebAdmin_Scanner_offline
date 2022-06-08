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
                <h3 class="card-title">Data Poin Customer</h3>
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

                {{-- {{ route('hadiah.index')}} --}}
                <form method="GET" action="">
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
                            <th>Total Poin Scanning</th>
                            {{-- <th style="width: 170px">Action
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        {{-- @if (is_array($sisaPoin) || is_object($sisaPoin)) --}}
                        @foreach ($poin_user as $data)
                        <tr class="odd">
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->email}}</td>
                            <td>{{ $data->totalPoin}}</td>
                        </tr>
                        @endforeach
                        {{-- @endif --}}
                    </tbody>
                </table>
                <p>
                    {{ $poin_user->links() }}
            </div>
        </div>
    </div>
</section>
    
@endsection