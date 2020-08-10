

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Pengaturan API Key</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=base_url("index.php/admin/dashboard");?>">Home</a></li>

              <li class="breadcrumb-item active">Pengaturan API Key</li>

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

                            Rajaongkir API

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="col-md-6 col-sm-12">

                            <form class="save-form">

                                <div class="form-group">

                                    <label>API Key</label> :

                                    <input type="text" name="key_api" value="<?=$this->shop_setting->rajaongkir_key();?>" class="form-control validate">

                                    <div class="invalid-feedback"></div>

                                </div>

                                <div class="form-group">

                                    <label>Tipe Akun</label> :

                                    <select name="type_api" class="form-control">

                                        <option value="starter"<?php if($this->shop_setting->rajaongkir_type() == "starter") { echo ' selected';} ?>>Starter</option>

                                        <option value="basic"<?php if($this->shop_setting->rajaongkir_type() == "basic") { echo ' selected';} ?>>Basic</option>

                                        <option value="pro"<?php if($this->shop_setting->rajaongkir_type() == "pro") { echo ' selected';} ?>>Pro</option>

                                    </select>

                                </div>

                            </form>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="button" class="btn btn-primary save"><i class="fas fa-save"></i> Simpan</button>

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

$('.save').on('click',function(){

    $('.save').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);

    $.ajax({

        url: "<?=base_url("index.php/admin/rajaongkir/save"); ?>",

        method: "POST",

        data: new FormData($('.save-form')[0]),

        contentType: false,

        cache: false,

        processData: false,

        dataType: "json",

        success:function(result){

            $('.save').html('<i class="fas fa-save"></i> Simpan').prop('disabled',false);

            if(result['status']) {

                $('.validate').removeClass("is-invalid");



                Swal.fire(

                    'Berhasil',

                    '',

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