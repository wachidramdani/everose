
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Midtrans API</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url("index.php/admin/dashboard");?>">Home</a></li>
              <li class="breadcrumb-item active">Midtrans API</li>
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
                            Konfigurasi
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6 col-sm-12">
                            <form class="save-form">
                                <div class="form-group">
                                    <label>ServerKey</label> :
                                    <input type="text" name="serverkey_midtrans" class="form-control validate" value="<?=$value['serverkey'];?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>ClientKey</label> :
                                    <input type="text" name="clientkey_midtrans" class="form-control validate" value="<?=$value['clientkey'];?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-save"><i class="fas fa-save"></i> Simpan</button>
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
$('.btn-save').on('click',function(){
    $('.btn-save').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);
    $.ajax({
        url: "<?=base_url("index.php/admin/midtrans/save"); ?>",
        method: "POST",
        data: new FormData($('.save-form')[0]),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success:function(result){
            $('.btn-save').html('<i class="fas fa-save"></i> Simpan').prop('disabled',false);
            if(result['status']) {
                $('.validate').removeClass("is-invalid");

                Swal.fire(
                    'Berhasil',
                    'API Key berhasil diperbaharui',
                    'success'
                );
            } else {
                var count = result['error'].length;
                var i;
                $('.validate').removeClass("is-invalid");

                for(i=0;i<count;i++) {
                    var field = result['error'][i]['field'];
                    var msg = result['error'][i]['msg'];

                    $(".validate[name="+field+"]").addClass("is-invalid");
                    $(".validate[name="+field+"]").parent().children(".invalid-feedback").html(msg);
                }

                Swal.fire(
                    'Gagal',
                    'Periksa kembali data anda',
                    'error'
                )
            }
        }
    });
});
</script>
