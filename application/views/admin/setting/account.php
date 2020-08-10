<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Edit Profile</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=('index.php/admin/dashboard');?>">Home</a></li>

              <li class="breadcrumb-item active">Edit Profile</li>

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

                <div class="col-md-5">

                    <div class="card">

                        <div class="card-header bg-gradient-info">

                            <div class="card-title">

                                <i class="fas fa-image"></i> Photo Profile

                            </div>

                        </div>

                        <div class="card-body" style="text-align:center">

                            <img src="<?=base_url($admin_info['photo_profile']);?>" id="profilepic" style="max-width:70%"/>

                        </div>

                        <div class="card-footer" style="text-align:center">

                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#setPhoto">Ganti Photo Profile</button>

                        </div>

                    </div>

                </div>

                <div class="col-md-7">

                    <div class="card">

                        <div class="card-header bg-gradient-info">

                            <div class="card-title">

                                <i class="fas fa-edit"></i> Info Dasar

                            </div>

                        </div>

                        <form class="save-form" novalidate>

                        <div class="card-body">

                                <div class="form-group">

                                    <label>Nama Lengkap</label> :

                                    <input type="text" name="name_profile" class="form-control validate" value="<?=$admin_info['name_profile'];?>">

                                    <div class="invalid-feedback"></div>

                                </div>

                                <div class="form-group">

                                    <label>Jenis Kelamin</label> :

                                    <div>

                                        <div class="form-check-inline">

                                            <label class="form-check-label">

                                                <input type="radio" class="form-check-input validate" name="gender_profile" value="Laki-laki" <?php if($admin_info['gender_profile'] == "Laki-laki") { echo "checked"; } ?>>Laki-laki

                                                <div class="invalid-feedback"></div>

                                            </label>

                                        </div>

                                        <div class="form-check-inline">

                                            <label class="form-check-label">

                                                <input type="radio" class="form-check-input" name="gender_profile" value="Perempuan" <?php if($admin_info['gender_profile'] == "Perempuan") { echo "checked"; } ?>>Perempuan

                                            </label>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Email</label> :

                                    <input type="email" name="email_profile" class="form-control validate" value="<?=$admin_info['email_profile'];?>">

                                    <div class="invalid-feedback"></div>

                                </div>

                                <div class="form-group">

                                    <label>Nomor Handphone</label> :

                                    <input type="text" name="phone_profile" class="form-control validate" value="<?=$admin_info['phone_profile'];?>">

                                    <div class="invalid-feedback"></div>

                                </div>

                                <div class="form-group">

                                    <label>Alamat Lengkap</label> :

                                    <textarea name="address_profile" class="form-control validate"><?=$admin_info['address_profile'];?></textarea>

                                    <div class="invalid-feedback"></div>

                                </div>

                        </div>

                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary btn-save"><i class="fas fa-save"></i> Simpan</i></button>

                        </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<div class="modal" id="setPhoto" tabindex="-1" role="dialog" aria-labelledby="setPhotoTitle" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="setPhotoTitle">Ganti Foto</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form action="<?=base_url('admin/edit_profile/save_photo');?>" method="post" enctype="multipart/form-data" class="upload-form">

                <div class="modal-body">

                    <div class="form-group">

                        <label>Pilih Foto</label> :

                        <input type="file" name="upload" class="form-control upload-field">

                    </div>

                    <div class="progress" style="display:none;width:100%">

                        <div class="progress-bar progress-bar-striped active" role="progressbar"

                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:10%">

                            10%

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary btn-upload"><i class="fas fa-upload"></i> Upload</button>

                </div>

            </form>

        </div>

    </div>

</div>



<script>

$('.save-form').on('submit',function(){

    event.preventDefault();

    $('.btn-save').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);

    $.ajax({

        url: "<?=base_url();?>index.php/admin/edit_profile/save",

        method: "POST",

        data: new FormData(this),

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

                    'Profile berhasil diedit',

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



$('.upload-form').on('submit',function(){

    event.preventDefault();

    $(".progress").toggle();

    $(".btn-upload").prop("disabled",true);

    $.ajax({

        url: "<?=base_url();?>index.php/admin/edit_profile/save_photo",

        method: "POST",

        data: new FormData(this),

        contentType: false,

        cache: false,

        processData: false,

        dataType: "json",

        xhr: function() {

                var xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function(evt) {

                    if (evt.lengthComputable) {

                        var percentComplete = ((evt.loaded / evt.total) * 100);

                        $(".progress-bar").width(percentComplete + '%');

                        $(".progress-bar").html(percentComplete+'%');

                    }

                }, false);

                return xhr;

            },

        success: function(result) {

            if(result['status']) {

                $(".btn-upload").prop("disabled",false);

                $('#setPhoto').modal('toggle');

                $(".progress").toggle();

                Swal.fire(

                    'Berhasil',

                    'Photo profile telah diperbaharui',

                    'success'

                );

                $("#profilepic").attr("src","<?=base_url();?>"+result['url']);

                $(".upload-field").val("");

            }

        }

    });

});

</script>