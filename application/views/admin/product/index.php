
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kelola Produk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url("index.php/admin/dashboard");?>">Home</a></li>
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
                        <div class="card-title">Produk</div>
                    </div>
                    <div class="card-body">
                      <div class="mb-4">
                        <a href="<?=base_url("index.php/admin/product/add");?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Produk</a>
                      </div>
                      <hr/>
                      <div class="table-responsive">
                        <table class="table table-bordered" id="tableProduct">
                            <thead class="bg-gradient-secondary">
                                <tr>
                                    <th scope="col" style="text-align:center">#</th>
                                    <th scope="col" style="text-align:center">Nama Produk</th>
                                    <th scope="col" style="text-align:center">Harga Produk</th>
                                    <th scope="col" style="text-align:center">Stok Produk</th>
                                    <th scope="col" style="text-align:center">Berat Product</th>
                                    <th scope="col" style="text-align:center">Kategori</th>
                                    <th scope="col" style="text-align:center">Diupdate</th>
                                    <th scope="col" style="text-align:center">Action</th>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
      $('#tableProduct').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {"url": "<?=base_url();?>index.php/admin/product/index_json"},
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
                "className": "dt-center"
            },
            {
                "targets": [ 3 ],
                "className": "dt-right"
            },
            {
                "targets": [ 4 ],
                "className": "dt-right"
            },
            {
                "targets": [ 5 ],
                "className": "dt-center"
            },
            {
                "targets": [ 6 ],
                "className": "dt-center"
            },
            {
                "targets": [ 7 ],
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
          text: "Kamu akan menghapus produk "+name,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((result) => {
          if (result.value) {
            $.getJSON("<?=base_url();?>index.php/admin/product/delete/"+id,function(response){
              if(!response['status']) {
                Swal.fire(
                    'Gagal',
                    response['msg'],
                    'error'
                );
              } else {
                $('#tableProduct').DataTable().ajax.reload( null, false );
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
