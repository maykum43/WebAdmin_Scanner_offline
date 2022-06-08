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
                {{--  --}}
                <form action="{{ route('update_sn',$data->id) }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label>SN</label>
                        <input type="text" name="sn" class="form-control" value="{{$data->sn}}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Model Produk</label>
                        <input type="text" name="model" class="form-control" value="{{$data->model}}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" value="{{$data->harga}}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Discount</label>
                        <input type="number" name="discount" id="discount" class="form-control" value="{{$data->discount}}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Poin</label>
                        <input type="number" name="poin" id="poin" class="form-control" value="{{$data->poin}}">
                    </div>
                    <!-- select -->
                    <div class="form-group" name="status">
                        <label>Status</label>
                        <select class="form-control" id="opsi_status" name="status">
                            <option>{{$data->status}}</option>
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

{{-- <script>
		
    var rupiah = document.getElementById('harga');
    rupiah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script> --}}
@endsection
