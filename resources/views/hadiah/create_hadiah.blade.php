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
                <h3 class="card-title">Tambah Data Hadiah</h3>
            </div>
            <div class="card-body">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('hadiah.store')}}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label>Request Poin</label>
                        <input type="number" name="req_poin" class="form-control @error('req_poin') is-invalid @enderror"
                            id="req_poin" value="{{ old('req_poin') }}" required autocomplete="req_poin" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Gambar Hadiah</label>
                        {{-- <img class="img-preview img-fluid"> --}}
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('req_poin') is-invalid @enderror" 
                                id="foto" name="foto">
                                <!-- onchange="previewImage()" -->
                                <label class="custom-file-label text-muted" >*Gambar harus berukuran 1080*1080 (png)</label>
                            </div>
                            <!-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> -->
                        </div>
                    </div>
                    <div class="form-group" name="status">
                        <label>Status</label>
                        <select class="form-control" id="opsi_status" name="status">
                            <option value="Aktif" id="Aktif">Aktif</option>
                            <option value="Non Aktif" id="Non Aktif">Non Aktif</option>
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

    function previewImage(){

        const image = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'blok';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }

    }

</script> --}}
@endsection
