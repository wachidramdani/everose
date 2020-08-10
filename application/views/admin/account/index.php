

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Kelola Admin</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=base_url('index.php/admin/dashboard');?>">Home</a></li>

              <li class="breadcrumb-item active">Kelola Admin</li>

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

                            <div class="card-title">Akun Admin</div>

                        </div>

                        <div class="card-body">

                            <div class="mb-4">

                                <button data-toggle="modal" data-target="#addModal" data-action="Tambah" type="button" class="btn btn-success btn-sm btn-show"><i class="fas fa-plus"></i> Tambah Akun</button>

                            </div>

                            <hr>

                            <div class="table-responsive">

                                <table class="table table-bordered" id="tableAccount">

                                    <thead class="bg-gradient-secondary">

                                        <tr>

                                            <th class="text-center">#</th>

                                            <th class="text-center">Username</th>

                                            <th class="text-center">Nama Lengkap</th>

                                            <th class="text-center">No. HP</th>

                                            <th class="text-center">Email</th>

                                            <th class="text-center">Aksi</th>

                                        </tr>

                                    </thead>

                                </table>

                            </div>

                        </div>

                        <div class="card-footer">



                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"><span class="action"></span> Akun</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <input type="hidden" id="idedit" value="">

                <form id="addForm">

                    <div class="form-group">

                        <label>Username</label> :

                        <input type="text" name="usn_admin" value="" class="form-control validate get">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="form-group">

                        <label>Password</label> :

                        <input type="password" name="pass_admin" value="" class="form-control validate get">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="form-group">

                        <label>Nama Lengkap</label> :

                        <input type="text" name="name_profile" value="" class="form-control validate get">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="form-group">

                        <label>Jenis Kelamin</label> :

                        <div>

                            <div class="form-check-inline">

                                <label class="form-check-label">

                                    <input type="radio" class="form-check-input validate gender1" name="gender_profile" value="Laki-laki">Laki-laki

                                    <div class="invalid-feedback"></div>

                                </label>

                            </div>

                            <div class="form-check-inline">

                                <label class="form-check-label">

                                    <input type="radio" class="form-check-input gender2" name="gender_profile" value="Perempuan">Perempuan

                                </label>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Email</label> :

                        <input type="text" name="email_profile" value="" class="form-control validate get">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="form-group">

                        <label>No. Handphone</label> :

                        <input type="text" name="phone_profile" value="" class="form-control validate get">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="form-group">

                        <label>Alamat</label> :

                        <textarea name="address_profile" class="form-control validate get"></textarea>

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="form-group">

                        <label>Foto</label> :

                        <input type="file" name="photo_profile" class="form-control validate">

                        <div class="invalid-feedback"></div>

                    </div>

                </form>

            </div>

            <div class="modal-footer" style="text-align:center">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                <button type="button" class="btn btn-primary save"><i class="fas fa-save"></i> Simpan</button>

            </div>

        </div>

    </div>

</div>



<script>

$('#tableAccount').DataTable({

        "processing": true,

        "serverSide": true,

        "order": [],

        "ajax": {"url": "<?=base_url();?>index.php/admin/account/index_json"},

        "columnDefs": [

            { 

                "targets": [ 0 ], 

                "orderable": false, 

                "className": "dt-center"

            },

            { 

                "targets": [ 3 ],  

                "className": "dt-center"

            },

            { 

                "targets": [ 4 ],  

                "className": "dt-center"

            },

            { 

                "targets": [ 5 ],  

                "orderable": false, 

                "className": "dt-center"

            }

            ]

    });



$('body').on('click','.btn-show',function(){

    var action = $(this).attr('data-action');

    $('.action').html(action);



    if(action == "Edit") {

        var id = $(this).attr('data-id');

        $('#idedit').val(id);

        $.getJSON('<?=base_url('index.php/admin/account/get/');?>'+id,function(result){

            $('.get[name=usn_admin]').val(result['usn_admin']);

            $('.get[name=pass_admin]').val(result['pass_admin']);

            $('.get[name=name_profile]').val(result['name_profile']);

            $('.get[name=email_profile]').val(result['email_profile']);

            $('.get[name=phone_profile]').val(result['phone_profile']);

            $('.get[name=address_profile]').val(result['address_profile']);

            if(result['gender_profile'] == "Laki-laki") {

                $('.gender1').attr('checked','checked');

            } else {

                $('.gender2').attr('checked','checked');

            }

        });

    }

});



$('.save').on('click',function(){

    var action = $('.action').html();

    if(action == 'Tambah') {

        var url = "<?=base_url("index.php/admin/account/add");?>";

    } else {

        var id = $('#idedit').val();

        var url = "<?=base_url('index.php/admin/account/edit/');?>"+id;

    }



    $('.save').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);

    $.ajax({

        url: url,

        method: "POST",

        data: new FormData($('#addForm')[0]),

        contentType: false,

        cache: false,

        processData: false,

        dataType: "json",

        success:function(result){

            $('.save').html('<i class="fas fa-save"></i> Simpan').prop('disabled',false);

            if(result['status']) {

                $('.validate').removeClass("is-invalid");



                $('#addForm')[0].reset();

                $('#addModal').modal('toggle');



                Swal.fire(

                    'Berhasil',

                    result['msg'],

                    'success'

                );

                $('#tableAccount').DataTable().ajax.reload( null, false );

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



$("body").on("click",".btn-delete",function(){

        var name = $(this).attr("data-name");

        var id = $(this).attr("data-id");

        Swal.fire({

          title: 'Apakah Kamu Yakin?',

          text: "Kamu akan menghapus akun "+name,

          showCancelButton: true,

          confirmButtonColor: '#3085d6',

          cancelButtonColor: '#d33',

          confirmButtonText: 'Ya'

        }).then((result) => {

          if (result.value) {

            $.getJSON("<?=base_url();?>index.php/admin/account/delete/"+id,function(response){

              if(!response['status']) {

                Swal.fire(

                    'Gagal',

                    response['msg'],

                    'error'

                );

              } else {

                $('#tableAccount').DataTable().ajax.reload( null, false );

                Swal.fire(

                    'Berhasil',

                    response['msg'],

                    'success'

                );

              }

            });

          }

        });

    }); 

</script>