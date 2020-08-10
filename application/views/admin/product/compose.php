<?php
if(isset($product_value)) {
    $photo_product = explode(",",$product_value->photo_product);
    $count_photo = count($photo_product);
    if(empty($photo_product[0])) {
        $count_photo = 0;
    }
    $id_photo = explode(",",$product_value->id_photo);
    $edit = 1;
} else {
    $edit = 0;
    $product_value = (object) array();
    $count_photo = 0;
    $product_value->name_product = "";
    $product_value->description_product = "";
    $product_value->price_product = "";
    $product_value->weight_product = "";
    $product_value->stock_product = "";
    $product_value->id_category = "";
    $product_value->id_product = 0;
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
              <li class="breadcrumb-item"><a href="<?=base_url("index.php/admin");?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url("index.php/admin/product");?>">Product</a></li>
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
        <form class="save-form">
        <div class="row d-flex flex-md-row-reverse">
            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-header bg-gradient-info">
                        <div class="card-title">
                            <i class="fas fa-images"></i> Foto Produk
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row append d-flex justify-content-center"> 
                            <?php
                            for($i=0;$i<$count_photo;$i++) {
                            ?>

                            <div class="col-5 img">
                                <div class="img-inserted m-1" style="background:url(<?=base_url("img/original/$photo_product[$i]");?>)center no-repeat;background-size:100% auto;height:130px">
                                    <div class="delete">
                                    <button type="button" class="btn btn-sm btn-danger btn-del" data-id="<?=$id_photo[$i];?>"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </div>

                            <?php
                            }
                            ?> 
                            <div class="col-5 img">
                                <div class="img-inserted m-1" style="height: 180px;display:none"></div>
                                <input type="file" class="add-img" name="foto[]" style="display:none">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align:center">
                        <button type="button" class="btn btn-secondary btn-add-img"><i class="fas fa-plus"></i> Masukkan Gambar
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-gradient-info">
                        <div class="card-title">
                            Warna & Ukuran
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Warna</label> :
                            <input type="text" name="warna" value="" class="form-control validate"> 
                            <div class="invalid-feedback"></div>
                        </div>
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label>Ukuran / Size</label> :
                                        <input type="number" name="size" value="" class="form-control validate"> 
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label>Stok Produk</label> :
                                        <input type="number" name="stock_product" value="" class="form-control validate"> 
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </td>
                            </tr>
                        </table> 
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-10">
                <div class="card">
                    <div class="card-header bg-gradient-info">
                        <div class="card-title">
                            <i class="fas fa-edit"></i> <?=$pagetitle;?>
                        </div>
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label>Nama Produk</label> :
                                <input type="text" name="name_product" class="form-control validate" value="<?=$product_value->name_product;?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Produk</label> :
                                <textarea name="description_product" rows="5" class="form-control validate"><?=$product_value->description_product;?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label>Harga Produk</label> :
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="number" name="price_product" class="form-control validate" value="<?=$product_value->price_product;?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga Beli</label> :
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="number" name="hargabeli" class="form-control validate" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga Investor</label> :
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="number" name="hargainvestor" class="form-control validate" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Investor</label> :
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="text" name="namainvestor" class="form-control validate" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Berat Produk</label> :
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-weight"></i></span>
                                    </div>
                                    <input type="number" name="weight_product" class="form-control validate" value="<?=$product_value->weight_product;?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kategori Produk</label> :
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                                    </div>
                                    <select name="id_category" class="form-control select2 validate">
                                        <?php foreach($data_category as $cat) { ?>
                                        <option value="<?=$cat['id_category'];?>" <?php if($cat['id_category'] == $product_value->id_category) { echo 'selected'; } ?>><?=$cat['name_category'];?></option>
                                        <?php } ?>

                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>                         
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary save"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('.img:last-child .img-inserted').attr('style', "background:url('"+e.target.result+"')center no-repeat;background-size:100% auto;height:130px");
      $('.img:last-child .img-inserted').append('<div class="delete"><button type="button" class="btn btn-sm btn-danger btn-del"><i class="fas fa-times"></i></button></div>');
      $(".append").append('<div class="col-5 img"><div class="img-inserted m-1" style="height: 180px;display:none"></div><input type="file" class="add-img" name="foto[]" style="display:none"></div>');
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$(".img-inserted").on("click",".btn-del",function(){
    var removing = $(this).parent(".delete").parent(".img-inserted").parent(".img");
    $(this).parent(".delete").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr("style","display: flex;color:white");
    var dataid = $(this).attr("data-id");
    if(dataid > 0) {
        $.getJSON("<?=base_url();?>index.php/admin/product/del_photo/"+dataid,function(result){
            if(result['status']) {
                removing.remove();
            }
        });
    } else {
        removing.remove();
    }
});

$("body").on("change",".add-img",function() {
    var img = $(this).prop("files")[0];
    readURL(this);
});

$(".btn-add-img").on("click",function(){
    $(".img:last-child .add-img").trigger("click");
});

$('.save').on('click',function(){
    $('.save').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> menyimpan').prop('disabled',true);
    $.ajax({
        url: "<?php if(!$edit) { echo base_url("index.php/admin/product/add_proccess"); } else {echo base_url("index.php/admin/product/edit_proccess/$product_value->id_product");} ?>",
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
                <?php if(!$edit) { ?>
                $('.save-form')[0].reset();
                $(".append").html('<div class="col-5 img"><div class="img-inserted m-1" style="height: 180px;display:none"></div><input type="file" class="add-img" name="foto[]" style="display:none"></div>');
                <?php } ?>

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