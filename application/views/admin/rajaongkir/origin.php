

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Pengaturan Origin</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=base_url("index.php/admin");?>">Home</a></li>

              <li class="breadcrumb-item active">Pengaturan Origin</li>

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

                                    <label>Provinsi</label> :

                                    <select name="province_api" class="form-control validate province csrf" data-csrf="<?=$this->security->get_csrf_hash();?>">

                                        <option>--- Pilih ---</option>

                                        <?php

                                        foreach($province['rajaongkir']['results'] as $prv) {

                                        ?>



                                        <option value="<?=$prv['province_id'];?>"<?php if($prv['province_id'] == $this->shop_setting->rajaongkir_province()) { echo ' selected'; } ?>><?=$prv['province'];?></option>

                                        <?php } ?>



                                    </select>

                                    <div class="invalid-feedback"></div>

                                </div>

                                <div class="form-group">

                                    <label>Kabupaten/Kota</label> :

                                    <select name="city_api" class="form-control city" <?php if($this->shop_setting->rajaongkir_province() < 1) { echo 'disabled';} ?>>

                                        <option>--- Pilih ---</option>

                                        <?php

                                        foreach($city['rajaongkir']['results'] as $ct) {

                                        ?>



                                        <option value="<?=$ct['city_id'];?>"<?php if($ct['city_id'] == $this->shop_setting->rajaongkir_city()) { echo ' selected'; } ?>><?=$ct['type'];?> <?=$ct['city_name'];?></option>

                                        <?php } ?>

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

$('body').on('change','.province',function(){

    var csrf = $(this).attr("data-csrf");

    var key = $(this).val();

    $.ajax({

            url: "<?=base_url("index.php/json/get_city");?>",

            method: "POST",

            data: {

                "key": key,

                "<?=$this->security->get_csrf_token_name();?>": csrf

            },

            dataType: "json",

            success:function(result){

                $('.csrf').attr("data-csrf",result['csrf_regenerate']);

                $('.city').prop("disabled",false);

                $('.city').html("<option>--- Pilih ---</option>");

                $.each(result['rajaongkir']['results'],function(){

                    $('.city').append('<option value="'+this.city_id+'-'+this.type+' '+this.city_name+'">'+this.type+' '+this.city_name+'</option>');

                });

            }

    });

});

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