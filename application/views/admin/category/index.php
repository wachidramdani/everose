

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Kelola Kategori</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=base_url("index.php/admin/dashboard");?>">Home</a></li>

              <li class="breadcrumb-item active">Kelola Kategori</li>

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

                            Kategori

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Kategori</button>

                        </div>

                        <hr/>

                        <div class="table-responsive">

                            <table class="table table-bordered" id="tableCategory">

                                <thead class="bg-gradient-secondary">

                                    <th scope="col" style="text-align:center">#</th>

                                    <th scope="col" style="text-align:center">Nama Kategory</th>

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



<!--/MODAL-->

<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Edit Kategori</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form id="editForm">

                    <div class="form-group">

                        <input type="text" name="name_category" value="" class="form-control validate txtName">

                        <div class="invalid-feedback"></div>

                    </div>

                    <input type="hidden" name="id" value="" class="form-control hdId">

                </form>

            </div>

            <div class="modal-footer" style="text-align:center">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                <button type="button" class="btn btn-primary btn-save"><i class="fas fa-save"></i> Simpan</button>

            </div>

        </div>

    </div>

</div>



<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Tambah Kategori</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form id="editForm">

                    <div class="form-group">

                        <input type="text" name="name_category" value="" class="form-control validate txtNameadd">

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





<script>

    $('body').on('click','.btnedit',function(){

        var txt = $(this).attr("data-name");

        var id = $(this).attr("data-id");

        

        $('.txtName').val(txt);

        $('.hdId').val(id);

    });

    $('#tableCategory').DataTable({

        "processing": true,

        "serverSide": true,

        "order": [],

        "ajax": {"url": "<?=base_url();?>index.php/admin/category/index_json"},

        "columnDefs": [

            { 

                "targets": [ 0 ], 

                "orderable": false, 

                "className": "dt-center"

            },

            {

                "targets": [ 2 ],

                "className": "dt-center",

                "orderable": false

            }

            ]

    });



    $("body").on("click",".btn-delete",function(){

        var name = $(this).attr("data-name");

        var id = $(this).attr("data-id");

        Swal.fire({

          title: 'Apakah Kamu Yakin?',

          text: "Kamu akan menghapus kategori "+name,

          showCancelButton: true,

          confirmButtonColor: '#3085d6',

          cancelButtonColor: '#d33',

          confirmButtonText: 'Ya'

        }).then((result) => {

          if (result.value) {

            $.getJSON("<?=base_url();?>index.php/admin/category/delete/"+id,function(response){

              if(!response['status']) {

                Swal.fire(

                    'Gagal',

                    response['msg'],

                    'error'

                );

              } else {

                $('#tableCategory').DataTable().ajax.reload( null, false );

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



    $('.btn-save').on('click',function(){

        var txt = $('.txtName').val();

        var id = $('.hdId').val();



        $('.btn-save').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);



        $.ajax({

            url: "<?=base_url("index.php/admin/category/edit");?>/"+id,

            method: "POST",

            data: {

                "name_category": txt 

            },

            dataType: "json",

            success:function(result){

                $('.btn-save').html('<i class="fas fa-save"></i> Simpan').prop('disabled',false);

                if(result['status']) {

                    $('.validate').removeClass("is-invalid");

                    $('#editModal').modal("toggle");

                    $('#tableCategory').DataTable().ajax.reload( null, false );

                    Swal.fire(

                        'Berhasil',

                        'Kategori berhasil diedit',

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



    $('.btn-saveadd').on('click',function(){

        var txt = $('.txtNameadd').val();



        $('.btn-saveadd').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);



        $.ajax({

            url: "<?=base_url("index.php/admin/category/add");?>/",

            method: "POST",

            data: {

                "name_category": txt 

            },

            dataType: "json",

            success:function(result){

                $('.btn-saveadd').html('<i class="fas fa-save"></i> Simpan').prop('disabled',false);

                if(result['status']) {

                    $('#addModal').modal("toggle");

                    

                    $('.validate').removeClass("is-invalid");

                    $('#tableCategory').DataTable().ajax.reload( null, false );

                    Swal.fire(

                        'Berhasil',

                        'Kategori telah ditambahkan',

                        'success'

                    );

                    $('.txtNameadd').val("");

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

</script>