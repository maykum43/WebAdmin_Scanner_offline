@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Beranda</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- box pesanan baru -->
          <div class="col-lg-4 col-3">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$hitScan}}</h3>
                <p>Scanner Terbaru</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('rwtsn') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- box semua transaksi -->
          <div class="col-lg-4 col-3">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$hitUser}}</h3>
                <!-- <sup style="font-size: 20px">%</sup> -->

                <p>Jumlah Customer</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('customer') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- box customer -->
          <div class="col-lg-4 col-3">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$hitSn}}</h3>
                <p>Jumlah Serial Number</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('sn') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- box semua produk -->
          {{-- <div class="col-lg-3 col-6"> --}}
            <!-- small box -->
            {{-- <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$hitModel}}</h3>

                <p>Jumlah Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> --}}

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
