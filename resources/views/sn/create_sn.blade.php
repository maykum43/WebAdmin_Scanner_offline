@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Serial Number</h3>
            </div>
            <div class="card-body">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                @php
                    $poin = round('poin')
                @endphp

                <form action="{{ route('simpan_sn')}}" method="POST" name="inputDataSn">
                    @csrf

                    <div class="form-group mb-3">
                        <label>SN</label>
                        <input type="text" name="sn" class="form-control @error('sn') is-invalid @enderror" id="sn"
                            value="{{ old('sn') }}" required autocomplete="sn" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label>Model</label>
                        <input type="text" name="model" class="form-control @error('model') is-invalid @enderror"
                            id="model" value="{{ old('model') }}" required autocomplete="model" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                            id="harga" value="{{ old('harga') }}" required autocomplete="harga" onkeyup="hitPoin()" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label>Discount</label>
                        <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror"
                            id="discount" value="{{ old('discount') }}" required autocomplete="discount" onkeyup="hitPoin()" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label>Poin</label>
                        <input type="number" name="poin" class="form-control @error('poin') is-invalid @enderror"
                            id="poin" value="$poin" required autocomplete="poin" onkeyup="hitPoin()" autofocus >
                    </div>
                    <!-- select -->
                    <div class="form-group" name="status">
                        <label>Status</label>
                        <select class="form-control" id="opsi_status" name="status">
                            <option value="Aktif" id="Aktif">Aktif</option>
                            <option value="Nonaktif" id="Nonaktif">Nonktif</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <button type="submit" class="btn btn-primary btn-mb-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>

    function hitPoin(){
    var hargaJual = document.getElementById('harga').value;
    var disc = document.getElementById('discount').value;

    //Rumusu Poin
    //=(D2-(D2-(D2*E2/100))*1)/100/120
    //D2 = Harga Jual
    //E2 = Discount

    // // var result = (parseInt(harga)/parseInt(disc))/parseInt(penentu);
    // var hargaDisc = harga-(harga*disc/100);
    // var hargaAsli = harga-hargaDisc;
    // var satuPer = hargaAsli*1/100;

    var result = Math.round((hargaJual-(hargaJual-(hargaJual*disc/100))*1)/100/100);
    
        if(!isNaN(result)){
            document.getElementById('poin').value=result;
        }
    }    
</script>
@endsection
