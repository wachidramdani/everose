<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Jasa Ekspedisi</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=base_url("index.php/admin");?>">Home</a></li>

              <li class="breadcrumb-item active">Jasa Ekspedisi</li>

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

                            Pilihan Jasa Pengiriman/Ekspedisi

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <button type="button" data-toggle="modal" data-target="#addCourier" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah</button>

                            <button type="button" data-toggle="modal" data-target="#logoCourier" class="btn btn-warning btn-sm toggle-upload"><i class="fas fa-upload"></i> Logo Jasa Ekspedisi</button>

                        </div><hr>

                        <div class="table-responsive">

                            <table class="table table-bordered" id="tableCourier">

                                <thead class="bg-gradient-secondary">

                                    <th scope="col" style="text-align:center">#</th>

                                    <th scope="col" style="text-align:center">Nama Penyedia</th>

                                    <th scope="col" style="text-align:center">Tipe Servis</th>

                                    <th scope="col" style="text-align:center">Aksi</th>

                                </thead>

                            </table>

                        </div>

                    </div>

                    <div class="card-footer">

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



  <div class="modal" id="addCourier" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Tambah</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form id="addForm">

                    <div class="form-group">

                        <label>Nama Penyedia Jasa</label> :

                        <input type="text" name="name_courier" value="" class="form-control validate txtNameadd">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="form-group">

                        <label>Tipe Servis</label> :

                        <input type="text" name="type_courier" value="" class="form-control validate txtTypeadd">

                        <div class="invalid-feedback"></div>

                    </div>

                </form>

            </div>

            <div class="modal-footer" style="text-align:center">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                <button type="button" class="btn btn-primary btn-saveadd"><i class="fas fa-save"></i> Simpan</button>

            </div>

        </div>

    </div>

</div>

  <div class="modal" id="editCourier" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Edit</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form id="editForm">

                    <div class="form-group">

                        <label>Nama Penyedia Jasa</label> :

                        <input type="text" name="name_courier" value="" class="form-control validate txtNameedit">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="form-group">

                        <label>Tipe Servis</label> :

                        <input type="text" name="type_courier" value="" class="form-control validate txtTypeedit">

                        <div class="invalid-feedback"></div>

                    </div>

                </form>

            </div>

            <div class="modal-footer" style="text-align:center">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                <button type="button" class="btn btn-primary btn-saveedit" data-id=""><i class="fas fa-save"></i> Simpan</button>

            </div>

        </div>

    </div>

</div>

  <div class="modal" id="logoCourier" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Upload Logo</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form class="uploadForm">

                    <div class="form-group">

                        <label>Penyedia Jasa</label> :

                        <select name="name" class="form-control option-field">

                        </select>

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="form-group">

                        <label>Logo</label> :

                        <input type="file" name="img" value="" class="form-control validate upload-field">

                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="progress" style="display:none;width:100%">

                        <div class="progress-bar progress-bar-striped active" role="progressbar"

                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:10%">

                            10%

                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer" style="text-align:center">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                <button type="button" class="btn btn-primary btn-upload"><i class="fas fa-save"></i> Simpan</button>

            </div>

        </div>

    </div>

</div>



<script>

    $('#tableCourier').DataTable({

        "processing": true,

        "serverSide": true,

        "order": [],

        "ajax": {"url": "<?=base_url();?>admin/rajaongkir/index_json"},

        "columnDefs": [

            { 

                "targets": [ 0 ], 

                "orderable": false, 

                "className": "dt-center"

            },

            {

                "targets": [ 3 ],

                "className": "dt-center",

                "orderable": false

            }

            ]

    });



    $('.btn-saveadd').on('click',function(){

        var name = $('.txtNameadd').val();

        var type = $('.txtTypeadd').val();



        $('.btn-saveadd').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);



        $.ajax({

            url: "<?=base_url("admin/rajaongkir/add_courier");?>",

            method: "POST",

            data: {

                "name_courier": name,

                "type_courier": type 

            },

            dataType: "json",

            success:function(result){

                $('.btn-saveadd').html('<i class="fas fa-save"></i> Simpan').prop('disabled',false);

                if(result['status']) {

                    $('.validate').removeClass("is-invalid");

                    $('#addForm')[0].reset();

                    $('#addCourier').modal("toggle");

                    $('#tableCourier').DataTable().ajax.reload( null, false );

                    Swal.fire(

                        'Berhasil',

                        'Jasa berhasil ditambahkan',

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

                }

            }

        });

    });

    

    $('body').on('click','.toggle-edit',function(){

        var id = $(this).attr("data-id");

        var name = $(this).attr("data-name");

        var type = $(this).attr("data-type");

        

        $('.txtNameedit').val(name);

        $('.txtTypeedit').val(type);

        $('.btn-saveedit').attr("data-id",id);

    });



    $("body").on("click",".toggle-delete",function(){

        var name = $(this).attr("data-name");

        var id = $(this).attr("data-id");

        Swal.fire({

          title: 'Apakah Kamu Yakin?',

          text: "Kamu akan menghapus pilihan "+name,

          showCancelButton: true,

          confirmButtonColor: '#3085d6',

          cancelButtonColor: '#d33',

          confirmButtonText: 'Ya'

        }).then((result) => {

          if (result.value) {

            $.getJSON("<?=base_url();?>admin/rajaongkir/delete_courier/"+id,function(response){

              if(!response['status']) {

                Swal.fire(

                    'Gagal',

                    response['msg'],

                    'error'

                );

              } else {

                $('#tableCourier').DataTable().ajax.reload( null, false );

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



    $('.btn-saveedit').on('click',function(){

        var name = $('.txtNameedit').val();

        var type = $('.txtTypeedit').val();

        var id = $(this).attr('data-id');



        $('.btn-saveedit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);



        $.ajax({

            url: "<?=base_url("admin/rajaongkir/edit_courier");?>/"+id,

            method: "POST",

            data: {

                "name_courier": name,

                "type_courier": type 

            },

            dataType: "json",

            success:function(result){

                $('.btn-saveedit').html('<i class="fas fa-save"></i> Simpan').prop('disabled',false);

                if(result['status']) {

                    $('.validate').removeClass("is-invalid");

                    $('#editCourier').modal("toggle");

                    $('#tableCourier').DataTable().ajax.reload( null, false );

                    Swal.fire(

                        'Berhasil',

                        'Jasa berhasil diedit',

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

                }

            }

        });



    });



$('.toggle-upload').on('click',function(){

    $.getJSON('<?=base_url('admin/rajaongkir/json_courier');?>',function(response){

        $('.option-field').html("");

        $.each(response,function(){

            $('.option-field').append('<option value="'+this+'">'+this+'</option>');

        });

    });

    

});



$('.btn-upload').on('click',function(){

    $(".progress").toggle();

    $(".btn-upload").prop("disabled",true);

    $.ajax({

        url: "<?=base_url();?>admin/rajaongkir/upload",

        method: "POST",

        data: new FormData($('.uploadForm')[0]),

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

                $('#logoCourier').modal("toggle");

                $(".progress").toggle();

                Swal.fire(

                    'Berhasil',

                    'Berhasil di upload',

                    'success'

                );

                $(".upload-field").val("");

                $('.uploadForm')[0].reset();

            } else {

                $(".btn-upload").prop("disabled",false);

                $(".progress").toggle();

                var count = result['error'].length;

                    var i;

                    $('.validate').removeClass("is-invalid");



                    for(i=0;i<count;i++) {

                        var field = result['error'][i]['field'];

                        var msg = result['error'][i]['msg'];



                        $(".validate[name="+field+"]").addClass("is-invalid");

                        $(".validate[name="+field+"]").parent().children(".invalid-feedback").html(msg);

                }

            }

        }

    });

});

</script>