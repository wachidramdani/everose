

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Kelola Halaman</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?=base_url('index.php/admin/dashboard');?>">Home</a></li>

              <li class="breadcrumb-item active">Kelola Halaman</li>

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

                            Halaman

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <a href="<?=base_url("index.php/admin/page/add");?>" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Halaman</a>

                        </div>

                        <hr/>

                        <div class="table-responsive">

                            <table class="table table-bordered" id="tablePage">

                                <thead class="bg-gradient-secondary">

                                    <tr>

                                        <th scope="col" style="text-align:center">#</th>

                                        <th scope="col" style="text-align:center">Judul Halaman</th>

                                        <th scope="col" style="text-align:center">URL Halaman</th>

                                        <th scope="col" style="text-align:center">Aksi</th>

                                    </tr>

                                </thead>

                            </table>

                        </div>

                    </div>

                    <div class="card-footer"></div>

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

    $('#tablePage').DataTable({

        "processing": true,

        "serverSide": true,

        "order": [],

        "ajax": {"url": "<?=base_url();?>index.php/admin/page/index_json"},

        "columnDefs": [

            { 

                "targets": [ 0 ], 

                "orderable": false, 

                "className": "dt-center"

            },

            { 

                "targets": [ 2 ],

                "className": "dt-center"

            },

            { 

                "targets": [ 3 ], 

                "orderable": false, 

                "className": "dt-center"

            }

            ]

    });



    $("body").on("click",".btn-del",function(){

        var name = $(this).attr("data-title");

        var id = $(this).attr("data-id");

        Swal.fire({

          title: 'Apakah Kamu Yakin?',

          text: "Kamu akan menghapus halaman "+name,

          showCancelButton: true,

          confirmButtonColor: '#3085d6',

          cancelButtonColor: '#d33',

          confirmButtonText: 'Ya'

        }).then((result) => {

          if (result.value) {

            $.getJSON("<?=base_url();?>index.php/admin/page/delete/"+id,function(response){

              if(!response['status']) {

                Swal.fire(

                    'Gagal',

                    response['msg'],

                    'error'

                );

              } else {

                $('#tablePage').DataTable().ajax.reload( null, false );

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