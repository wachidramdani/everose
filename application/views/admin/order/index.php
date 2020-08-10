

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Orderan</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=base_url('index.php/admin/dashboard');?>">Home</a></li>

              <li class="breadcrumb-item">Orderan</li>

            </ol>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <div class="content">

      <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header bg-gradient-info">

                        <div class="card-title">

                            <i class="fas fa-list"></i> Orderan Bulan Ini

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <div class="btn-group">

                                <button type="button" class="btn btn-danger btn-sm datafor">Semua</button>
                                <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"><span class="sr-only">Toggle Dropdown</span></button>
                                <button type="button" class="btn btn-primary btn-sm datafor" id="btn-ctklabel" style="margin-left: 20px" disabled>Cetak Label</button>

                                <div class="dropdown-menu" data-url="<?=base_url();?>admin/order/index_json">

                                    <button type="button" class="dropdown-item change-data" data-value="0">Semua</button>

                                    <button type="button" class="dropdown-item change-data" data-value="1">Belum Dibayar</button>

                                    <button type="button" class="dropdown-item change-data" data-value="2">Perlu Acc</button>

                                    <button type="button" class="dropdown-item change-data" data-value="3">Dikemas</button>

                                    <button type="button" class="dropdown-item change-data" data-value="4">Dikirim</button>

                                    <button type="button" class="dropdown-item change-data" data-value="5">Selesai</button>

                                </div>

                            </div>

                        </div><hr>

                        <div class="table-responsive">
                            <form method="post" action="<?php echo base_url('index.php/admin/order/cetak') ?>" id="form-cetak">
                                <table class="table table-bordered" id="tableOrder">

                                    <thead class="bg-secondary">

                                        <tr>
                                            <th><input type="checkbox" id="check-all"></th>
                                            <th scope="col" class="dt-center">#</th>

                                            <th scope="col" class="dt-center">Order ID</th>

                                            <th scope="col" class="dt-center">Nama</th>

                                            <th scope="col" class="dt-center">Grand Total</th>

                                            <th scope="col" class="dt-center">Status</th>

                                            <th scope="col" class="dt-center">Tanggal</th>

                                            <th scope="col" class="dt-center">Aksi</th>

                                        </tr>

                                    </thead>

                                </table>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-12">

                <div class="card">

                    <div class="card-header bg-gradient-info">

                        <div class="card-title">

                            <i class="fas fa-list"></i> Semua Orderan

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <div class="btn-group">

                                <button type="button" class="btn btn-danger btn-sm datafor">Semua</button>

                                <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"><span class="sr-only">Toggle Dropdown</span></button>

                                <div class="dropdown-menu" data-url="<?=base_url();?>admin/order/allindex_json">

                                    <button type="button" class="dropdown-item change-data" data-value="0">Semua</button>

                                    <button type="button" class="dropdown-item change-data" data-value="1">Belum Dibayar</button>

                                    <button type="button" class="dropdown-item change-data" data-value="2">Perlu Acc</button>

                                    <button type="button" class="dropdown-item change-data" data-value="3">Dikemas</button>

                                    <button type="button" class="dropdown-item change-data" data-value="4">Dikirim</button>

                                    <button type="button" class="dropdown-item change-data" data-value="5">Selesai</button>

                                </div>

                            </div>

                        </div><hr>

                        <div class="table-responsive">

                            <table class="table table-bordered" id="tableAllOrder">

                                <thead class="bg-secondary">

                                    <tr>

                                        <th scope="col" class="dt-center">#</th>

                                        <th scope="col" class="dt-center">Order ID</th>

                                        <th scope="col" class="dt-center">Nama</th>

                                        <th scope="col" class="dt-center">Grand Total</th>

                                        <th scope="col" class="dt-center">Status</th>

                                        <th scope="col" class="dt-center">Tanggal</th>

                                        <th scope="col" class="dt-center">Aksi</th>

                                    </tr>

                                </thead>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->



  <div class="modal" id="edit" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Status Order</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

            <form class="resi-form">

                <div class="form-group">

                    <label>Status</label> :

                    <select class="form-control edit-status" name="status">

                        <option value="3">Dikemas</option>

                        <option value="4">Dikirim</option>

                        <option value="5">Selesai</option>

                    </select>

                </div>

                <div class="form-group resi-wrap">

                    <label>No. Resi</label> :

                    <input type="text" class="form-control edit-resi" value="" name="resi">

                </div>

                <input type="hidden" name="id" value="" class="edit-id">

            </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-resi-save btn-primary">Simpan</button>

            </div>

        </div>

    </div>

  </div>



  <div class="modal detail" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title">Detail Order <span class="detail-id"></span></h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

            </button>

        </div>

        <div class="modal-body">

            <div class="row mb-2" style="font-size: small;word-wrap:break-word">

                <div class="col-6">

                    <div class="mb-2">

                        <b>Nama</b> : <br/>

                        <span class="detail-name"></span>

                    </div>

                    <div class="mb-2">

                        <b>Nomor HP</b> : <br/>

                        <span class="detail-hp"></span>

                    </div>

                    <div class="mb-2">

                        <b>Email</b> : <br/>

                        <span class="detail-email"></span>

                    </div>

                    <div class="mb-2">

                        <b>Tanggal Order</b> : <br/>

                        <span class="detail-date"></span>

                    </div>

                </div>

                <div class="col-6">

                    <div class="mb-2">

                        <b>Alamat</b> : <br/>

                        <span class="detail-address"></span>

                    </div>

                    <div class="mb-2">

                        <b>Kurir</b> : <br/>

                        <span class="detail-courier"></span>

                    </div>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table table-sm detail-cart table-bordered" style="font-size:small">

                    <thead>

                        <tr>

                            <td class="text-center">Nama Produk</td>

                            <td class="text-center">Qty</td>

                            <td class="text-center">Harga Satuan</td>

                            <td class="text-center">Sub-Total</td>

                        </tr>

                    </thead>

                    <tbody>

                    </tbody>

                    <tfoot>

                        <tr>

                            <td colspan="3" class="text-right">Total</td>

                            <td class="text-right detail-total"></td>

                        </tr>

                        <tr>

                            <td colspan="3" class="text-right">Ongkos Kirim</td>

                            <td class="text-right detail-shipping"></td>

                        </tr>

                        <tr>

                            <td colspan="3" class="text-right">Grand Total</td>

                            <td class="text-right detail-grand"></td>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>

        </div>

    </div>

  </div>





  <script>



  function toggleresi(status) {

    if(status == 4) {

        $('.resi-wrap').show();

    } else {

        $('.resi-wrap').hide();

    }

  }



  toggleresi(0);



  $('.edit-status').on('change',function(){

    var status = $(this).val();

    toggleresi(status);

  });



  $("body").on("click",".btn-edit",function(){

      $('.edit-resi').val("");

      var id = $(this).attr("data-id");

      $.getJSON("<?=base_url("index.php/admin/order/get_json/");?>"+id,function(result){

          $('.edit-status').val(result['status_invoice']);

          $('.edit-resi').val(result['no_resi']);

          toggleresi(result['status_invoice']);

          $('.edit-id').val(result['no_invoice']);

          $("#edit").modal("toggle");

      });

  });



  $(".btn-resi-save").on('click',function(){

    $.ajax({

        url: "<?=base_url("index.php/admin/order/edit_resi");?>",

        method: "POST",

        data: new FormData($('.resi-form')[0]),

        contentType: false,

        cache: false,

        processData: false,

        dataType: "json",

        success:function(result){



            $('#edit').modal("toggle");

            $('#tableOrder').DataTable().ajax.reload( null, false );

            $('#tableAllOrder').DataTable().ajax.reload( null, false );

            

            Swal.fire(

                    'Berhasil',

                    'Status order telah diperbaharui',

                    'success'

                );

        }

    });

  });



  $("body").on("click",".btn-detail",function(){

      var id = $(this).attr("data-id");

      $.getJSON("<?=base_url("index.php/admin/order/get_json/");?>"+id,function(result){

        $('.detail-id').html("#"+result['no_invoice']);

        $('.detail-name').html(result['name_invoice']);

        $('.detail-hp').html(result['hp_invoice']);

        $('.detail-email').html(result['email_invoice']);

        $('.detail-address').html(result['address_invoice']);

        $('.detail-courier').html(result['courier_invoice']);

        $('.detail-date').html(result['date_invoice']);

        $('.detail-total').html(result['total_invoice']);

        $('.detail-shipping').html(result['shipping_invoice']);

        $('.detail-grand').html(result['grand_invoice']);

        $('.detail-cart tbody').html("");

        $.each(result['data'],function(){

            $('.detail-cart tbody').append('<tr><td>'+this.product_detail+'</td><td class="text-center">'+this.qty_detail+'</td><td class="text-right">'+this.price_detail+'</td><td class="text-right">'+this.sub_detail+'</td></tr>');

        });

        $(".detail").modal("toggle");

      });

  });



  function reload(dom,data,datafor,url) {

    $(dom).parent().parent().children(".datafor").html(datafor);



    var dom2 =  $(dom).parent().parent().parent().parent().find(".table");



    if(data == 0) {

        dom2.DataTable().ajax.url(url).load();

    } else {

        dom2.DataTable().ajax.url(url+"?status="+data).load();

    }

  }



  $('.change-data').on('click',function(){

    var data = $(this).attr("data-value");

    var datafor = $(this).html();

    var url = $(this).parent().attr("data-url")

    reload(this,data,datafor,url);

  });



  function ajaxtable(table,url) {



    $(table).DataTable({

        "processing": true,

        "serverSide": true,

        "order": [],

        "ajax": {"url": url},

        "columnDefs": [

            { 

                "targets": [ 0 ], 

                "orderable": false, 

                "className": "dt-center"

            },

            { 

                "targets": [ 1 ], 

                "className": "dt-center"

            },

            { 

                "targets": [ 3 ], 

                "className": "dt-right"

            },

            { 

                "targets": [ 4 ], 

                "className": "dt-center"

            },

            { 

                "targets": [ 5 ], 

                "className": "dt-center"

            },

            { 

                "targets": [ 6 ], 

                "className": "dt-center"

            }

            ]

    });



  }

  $(document).ready(function(){ 
    $("#check-all").click(function(){
      if($(this).is(":checked")){
        $(".check-item").prop("checked", true);
        $("#btn-ctklabel").prop("disabled", false);
      }else{
        $(".check-item").prop("checked", false);
      }
    });

    $(".check-item").click(function(){
        $("#btn-ctklabel").prop("disabled", false);
    });
    
    $("#btn-ctklabel").click(function(){ 
      var confirm = window.confirm("Yakin data yang akan diprint sudah benar?");
      
      if(confirm)
        $("#form-cetak").submit();
    });
  });



  ajaxtable("#tableOrder","<?=base_url();?>index.php/admin/order/index_json");

  ajaxtable("#tableAllOrder","<?=base_url();?>index.php/admin/order/allindex_json")

</script>

