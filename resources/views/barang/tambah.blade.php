<!-- jQuery -->
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Parsley -->
<script src="{{ asset('assets/vendors/parsleyjs/dist/parsley.min.js') }}"></script>


@extends('layouts.master')
@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}">    
@endsection
@section('title', 'Tambahkan Barang - Tes Praktek Backend')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-uppercase">Tambahkan Barang </h2>
                <div class="clearfix"></div>
            </div>
            
            {{-- menampilkan error validasi --}}
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="post" action="{{ route('barang.store') }}" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left">
                @csrf
                    <div class="x_content">
                        <div class="item form-group">
                            <label for="nama" class="col-form-label col-md-3 col-sm-3 label-align">Nama Barang </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="nama" class="form-control" required="required" type="text" name="nama" value="{{ old('nama') }}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="harga_beli">Harga Beli
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="harga_beli" name="harga_beli" required="required" class="form-control" data-parsley-type="digits" value="{{ old('harga_beli') }}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="harga_beli">Harga Jual
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="harga_jual" name="harga_jual" required="required" class="form-control" data-parsley-type="digits" value="{{ old('harga_jual') }}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="harga_beli">Stok
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="stok" name="stok" required="required" class="form-control" data-parsley-type="digits" value="{{ old('stok') }}">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="gambar">Foto </label>
                            <div class="col-md-6 col-sm-6 ">
                                <div class="input-group">
                                    <input id="file" class="form-control" type="file" name="file" required>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('barang.index') }}" class="btn btn-info" type="button">Kembali</a>
                            </div>
                        </div>

                    
            
                </div>
            </form>
        </div>
    </div>
        
{{-- </div> --}}



<script>
   

</script>

@endsection




    

