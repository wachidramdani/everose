
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Laporan Penjualan Rangkuman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url("index.php/admin/dashboard");?>">Home</a></li>
              <li class="breadcrumb-item active">Laporan Penjualan Rangkuman</li>
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
                            Laporan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4 form-inline">
                            <div class="form-group mr-1">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm float-right" id="reservation">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <button type="button" data-toggle="modal" data-target="#addCourier" class="btn btn-danger btn-sm mr-1 btn-pdf"><i class="fas fa-file-pdf"></i> PDF</button>
                        </div><hr>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tableReport">
                                <thead class="bg-gradient-secondary">
                                    <tr>
                                        <th style="width:15%">Tanggal</th>
                                        <th style="width:15%">Order ID</th>
                                        <th style="width:25%">Nama Pelanggan</th>
                                        <th style="width:15%">Total</th>
                                        <th style="width:15%">Ongkos Kirim</th>
                                        <th style="width:15%">Grand Total</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th class="total">0</th>
                                        <th class="shipping">0</th>
                                        <th class="grand">0</th>
                                    </tr>
                                </tfoot>
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
<script>
$('#reservation').daterangepicker();

var range = $('#reservation').val();

function gettotal(range1) {
    $.getJSON("<?=base_url();?>index.php/admin/report/total_json?range="+range1,function(result){
        $('.total').html(result['total']);
        $('.shipping').html(result['shipping']);
        $('.grand').html(result['grand']);
    });
}

gettotal(range);

$('#tableReport').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {"url": "<?=base_url();?>index.php/admin/report/create_json?range="+range},
        "columnDefs": [
            {
                "targets": [ 3 ], 
                "className": "dt-right"
            },
            {
                "targets": [ 4 ], 
                "className": "dt-right"
            },
            {
                "targets": [ 5 ], 
                "className": "dt-right"
            }
        ]
    });

$('#reservation').on('change',function(){
    var range = $('#reservation').val();

    gettotal(range);
    $('#tableReport').DataTable().ajax.url("<?=base_url();?>index.php/admin/report/create_json?range="+range).load();

});

$('.btn-pdf').on("click",function(){
    var range = $('#reservation').val();

    location.href="<?=base_url("index.php/admin/report/pdf_report?range=");?>"+range;
});
</script>