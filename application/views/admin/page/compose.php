<?php

if(isset($page_value)) {

    $edit = 1;

} else {

    $edit = 0;

    $page_value = (object) array();

    $page_value->id_page = 0;

    $page_value->title_page = "";

    $page_value->body_page = "";

    $page_value->url_page = "";

}

?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><?=$pagetitle;?></h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=base_url('index.php/admin');?>">Home</a></li>

              <li class="breadcrumb-item"><a href="<?=base_url('index.php/admin/page');?>">Halaman</a></li>

              <li class="breadcrumb-item active"><?=$pagetitle;?></li>

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

                            Compose

                        </div>

                    </div>

                    <div class="card-body">

                        <form class="save-form">

                            <div class="form-group">

                                <label>Judul Halaman</label> :

                                <input type="text" name="title_page" class="form-control validate" value="<?=$page_value->title_page;?>">

                                <div class="invalid-feedback"></div>

                            </div>

                            <div class="form-group">

                                <label>Isi Halaman</label> :

                                <textarea name="body_page" class="form-control validate textnya"><?=$page_value->body_page;?></textarea>

                                <div class="invalid-feedback"></div>

                            </div>

                            <div class="form-group">

                                <label>Url Halaman</label> :

                                <div class="input-group">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text">page/</span>

                                    </div>

                                    <input type="text" name="url_page" class="form-control validate" value="<?=$page_value->url_page;?>">

                                    <div class="invalid-feedback"></div>

                                </div>

                            </div>

                        </form>

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

  $(function () {

    // Summernote

    $('.textnya').summernote()

  })



  $('.btn-save').on('click',function(){



    $('.btn-save').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);



    $.ajax({

        url: "<?php if(!$edit) { echo base_url("index.php/admin/page/add_proccess"); } else { echo base_url("index.php/admin/page/edit_proccess/$page_value->id_page"); }?>",

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



                <?php if(!$edit) { ?>



                $('.save-form input[type=text]').val("");

                $(function () {

                    // Summernote

                    $('.textnya').summernote("reset")

                })



                <?php } ?>



                Swal.fire(

                    'Berhasil',

                    result['msg'],

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

