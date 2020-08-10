
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
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

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Perlu Dikirim</span>
                <span class="info-box-number"><?=$num_send;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Rating Rata-rata</span>
                <span class="info-box-number"><?=$num_rating;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-check-square"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Order Selesai</span>
                <span class="info-box-number"><?=$num_success;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-exclamation"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Stok Habis</span>
                <span class="info-box-number"><?=$num_stock;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

        </div>
        

        <!-- /.row -->
        <div class="row">
          <section class="col-md-7 col-sm-12">
            <div class="card bg-gradient-secondary">
              <div class="card-header">
                <div class="card-title">Ulasan Terbaru</div>
              </div>
              <div class="card-body">
              <?php
              foreach($comments as $comment) {
              ?>

                <div class="card bg-light">
                  <div class="card-header">
                    <div class="card-title"><?=$comment->name_comment;?> <span class="d-block" style="font-size:15px"><?=$comment->email_comment;?></span></div>
                  </div>
                  <div class="card-body">
                    <div style="font-size: 7px;color:#FF9900"><?=$this->toolset->rating($comment->rating_comment);?></div>
                    <?=$comment->body_comment;?>
                  </div>
                  <div class="card-footer">
                    - <?=$comment->name_product;?>
                    <span class="float-right"><?=$comment->date_comment;?></span>
                  </div>
                </div>
              <?php } ?>

              </div>
            </div>
          </section>
          <section class="col-md-5 col-sm-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                  Stok Hampir Habis
                </div>
              </div>
              <div class="card-body">
                  <ul class="list-group">
                  <?php
                  foreach($stocks as $stock) {
                  ?>

                    <li class="list-group-item"><?=$stock->name_product;?> <span class="float-right badge badge-danger"><?=$stock->stock_product;?></span></li>
                  <?php } ?>
                  
                  </ul>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
