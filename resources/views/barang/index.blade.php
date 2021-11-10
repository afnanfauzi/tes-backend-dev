<!-- jQuery -->
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
@extends('layouts.master')
@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}">    
@endsection
@section('title', 'Daftar Barang - Tes Praktek Backend')
@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2 class="text-uppercase">Daftar Barang</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <div class="col-md-10">
                    <p>Berikut adalah daftar barang yang tersedia</p>
                  </div>
                  <div class="col-md-2" style="text-align: right;">
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="tambah-barang"><i class="fa fa-plus"></i> Tambah Barang</a>
                  </div>
  
                  <table class="table table-striped table-bordered dt-responsive nowrap" id="table-barang" style="width:100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Foto</th>
                        <th>Aksi</th>

                    </tr>
                    </thead>
                    </table>

                 </div>
               </div>
            </div>
        </div> 
    </div>
  </div> 
  
  <!-- MULAI MODAL FORM TAMBAH/EDIT-->
  <div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
      <div class="modal-dialog ">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="modal-judul"></h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate>
                      <div class="row">
                          <div class="col-sm-12">

                              <input type="hidden" name="id" id="id">

                              <div class="form-group">
                                <div class="col-sm-12 d-flex">
                                    <label for="nama" class="col-sm-8 control-label" style="padding-left: 0px;">Kode</label>
                                    <a class="btn btn-primary btn-sm text-white col-sm-4" id="generate" onClick="getElementById('kode').value=Math.random().toString(36).slice(2);">Generate Kode</a>
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control text-uppercase" id="kode" name="kode" placeholder="" value="" required="required" readonly>
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="nama" class="col-sm-12 control-label">Nama</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="" value="" required="required">
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="harga_beli" class="col-sm-12 control-label">Harga Beli</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" placeholder="" value="" required="required" data-parsley-type="digits">
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="harga_jual" class="col-sm-12 control-label">Harga Jual</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="" value="" required="required" data-parsley-type="digits">
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="stok" class="col-sm-12 control-label">Stok</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="stok" name="stok" placeholder="" value="" required="required" data-parsley-type="digits">
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="file" class="col-sm-12 control-label">Foto</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="file" name="file">
                                    <input type="hidden" name="fotoLama" id="fotoLama">
                                </div>
                                <label for="file" class="col-sm-12 control-label"><span class="required">* </span>Format png/jpg max 100 KB</label>
                                <div id="response" class="col-sm-12 text-danger"></div>
                            </div> 
                          </div>
                      </div>

                  
              </div>
              <div class="modal-footer">
                <div class="col-sm-offset-2 col-sm-12" >
                    <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                        value="create">Simpan
                    </button>
                </div>
              </div>
            </form>
          </div>
      </div>
  </div>
  <!-- AKHIR MODAL -->

  <!-- MULAI MODAL KONFIRMASI DELETE-->

  <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">PERHATIAN</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p><b>Jika menghapus data barang ini maka data tersebut akan hilang selamanya, apakah anda yakin?</b></p>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                      Data</button>
              </div>
          </div>
      </div>
  </div>

  <!-- AKHIR MODAL -->
@endsection



    <!-- JAVASCRIPT -->
    <script>
        //CSRF TOKEN PADA HEADER
        //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //TOMBOL TAMBAH DATA
            //jika tambah-barang diklik maka
            $('#tambah-barang').click(function () {
                $('#tombol-simpan').val("create-post"); //valuenya menjadi create-post
                $('#generate').show();
                $('#id').val(''); //valuenya menjadi kosong
                $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
                $('#modal-judul').html("Tambah Barang"); //valuenya tambah barang baru
                $('#tambah-edit-modal').modal('show'); //modal tampil   
                });
        });
  
  
  
        //MULAI DATATABLE
        //script untuk memanggil data json dari server dan menampilkannya berupa datatable
        $(document).ready(function () {
            $('#table-barang').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('barang.index') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'id', 
                        name: 'id', 'visible': false
                    },
                    {
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', orderable: false,searchable: false
                    },
                    {
                        data: 'nama', 
                        name: 'nama' 
                    },
                    {
                        data: 'kode', 
                        name: 'kode' 
                    },
                    {
                        data: 'harga_beli', 
                        name: 'harga_beli' 
                    },
                    {
                        data: 'harga_jual', 
                        name: 'harga_jual' 
                    },
                    {
                        data: 'stok', 
                        name: 'stok' 
                    },
                    {
                        data: 'image', 
                        name: 'image' 
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,searchable: false
                    },
  
                ],
                columnDefs: [
                    {
                        targets: 4,
                        render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                    },
                    {
                        targets: 5,
                        render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });
  

        $(document).ready(function () {  

        $('body').on('submit', '#form-tambah-edit', function (e) {
            e.preventDefault();
            var actionType = $('#tombol-simpan').val();
            $('#tombol-simpan').html('Sending..');
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: "{{ route('barang.store') }}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    // var json = JSON.stringify(data);
                    // var conv = JSON.parse(json);
                    // alert(conv["data"]);
                //    if($('input[name=nama]').val() != ""){
                //     $('input[name=nama]').val(''); //valuenya menjadi kosong
                //     $('input[name=nama]').val(conv["data"]);
                //    }


                    $('#form-tambah-edit').trigger("reset"); //form reset
                    $('#response').hide(); 
                    $('#tambah-edit-modal').modal('hide'); //modal hide
                    $('#tombol-simpan').html('Simpan'); //tombol simpan
                    var oTable = $('#table-barang').dataTable(); //inialisasi datatable
                    oTable.fnDraw(false); //reset datatable
                    iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                        title: 'Data Berhasil Disimpan',
                        message: '{{ Session('
                        success ')}}',
                        position: 'bottomRight'
                    });
                    $('#generate').show();
                        
                },
                error: function(data){
                    var json = JSON.stringify(data);
                    var conv = JSON.parse(json);
                    var isi = Object.values(conv);
                    // console.log(isi[2]["data"]["file"][0]);
                    var error = (isi[2]["data"]["file"][0]);
                    console.log(error); 
                    $('#response').show().html(error); 
                    $('#tombol-simpan').html('Simpan');
                }
                });
        });


        //TOMBOL EDIT DATA PER barang DAN TAMPIKAN DATA BERDASARKAN ID barang KE MODAL
        //ketika class edit-post yang ada pada tag body di klik maka
        $('body').on('click', '.edit-post', function () {
            var data_id = $(this).data('id');
            $.get('barang/' + data_id + '/edit', function (data) {
                // alert("Data: " + data);
                $('#modal-judul').html("Edit Barang");
                $('#tombol-simpan').val("edit-post");
                $('#tambah-edit-modal').modal('show');
                $('#generate').hide();
  
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#kode').val(data.kode);
                $('#harga_beli').val(data.harga_beli);
                $('#harga_jual').val(data.harga_jual);
                $('#stok').val(data.stok);

                if(data.foto){
                    $('#fotoLama').val(data.foto);
                }
            })
        });

        //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });
  
        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({
                url: "barang/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#table-barang').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
                }
            })
        });
        
      });
  
    </script>
  
    <!-- JAVASCRIPT -->
    

