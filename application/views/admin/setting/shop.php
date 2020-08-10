        



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Pengaturan Toko</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=base_url('index.php/admin/dashboard');?>">Home</a></li>

              <li class="breadcrumb-item active">Pengaturan Toko</li>

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

                    <div class="card card-outline card-info">

                        <div class="card-header">

                            <div class="card-title">

                                <i class="fas fa-cog"></i>

                            </div>

                        </div>

                        <div class="card-body col-md-5 col-sm-12">

                            <form method="post" class="save-form" enctype="multipart/form-data">

            

                                <?php

                                foreach($getall as $form) {

                                    $inputrow = '<input type="'.$form->type_setting.'" name="send[]" class="form-control" value="'.$form->value_setting.'"/>';

                                    if($form->type_setting == "file") {

                                        $inputrow = '<input type="'.$form->type_setting.'" name="logo" class="form-control"/>';

                                    }

                                    if($form->type_setting == "textarea") {

                                        $inputrow = '<textarea name="send[]" class="form-control">'.$form->value_setting.'</textarea>';

                                    }

                                ?>

            

                                <div class="form-group">

            

                                    <label><?=$form->name_setting;?> :</label>

                                    <?=$inputrow;?>

            

                                </div>

                                <?php

                                    }

                                ?>

            

                                <button type="submit" class="btn btn-primary btn-save"><i class="fas fa-save"></i> Simpan</i></button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>  

        </div>

    </div>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

<script>

$('.save-form').on('submit',function(){

    event.preventDefault();

    $('.btn-save').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);

    $.ajax({

        url: "<?=base_url();?>index.php/admin/shop_setting/save",

        method: "POST",

        data: new FormData(this),

        contentType: false,

        cache: false,

        processData: false,

        dataType: "json",

        success:function(result){

            $('.btn-save').html('<i class="fas fa-save"></i> Simpan').prop('disabled',false);

            if(result['status']) {

                Swal.fire(

                    'Berhasil',

                    'Pengaturan toko telah diperbaharui',

                    'success'

                );

            } else {

                Swal.fire(

                    'Gagal',

                    ''+result['error'],

                    'error'

                )

            }

        }

    });

});

</script>