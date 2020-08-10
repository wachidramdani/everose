<?php
if(!isset($min)) {
    $min = "";
}
if(!isset($max)) {
    $max = "";
}
?>
<main>
  <!-- <div class="top_banner">
    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
      <div class="container">
        <div class="breadcrumbs">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Category</a></li>
            <li>Page active</li>
          </ul>
        </div>
        <h1>Shoes - Grid listing</h1>
      </div>
    </div>
    <img src="img/bg_cat_shoes.jpg" class="img-fluid" alt="">
  </div> -->
  <!-- /top_banner -->
  
    <div id="stick_here"></div>   
    <div class="toolbox elemento_stick">
      <div class="container">
        <ul class="clearfix">
          <li>
            Hasil Pencarian 
            <b><?=$pageinfo['total'];?> Produk</b>
          </li>
          <li>
            <a data-toggle="collapse" href="#filters" role="button" aria-expanded="false" aria-controls="filters">
              <i class="ti-filter"></i><span>Filters</span>
            </a>
          </li>
        </ul>
        <div class="collapse" id="filters">
          <div class="row small-gutters filters_listing_1">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <select id="input-sort" class="form-control">
                      <option value="id_product-DESC">Sortir</option>
                      <option value="name_product-ASC">Nama (A - Z)</option>
                      <option value="name_product-DESC">Nama (Z - A)</option>
                      <option value="price_product-ASC">Harga (Termurah &gt; Termahal)</option>
                      <option value="price_product-DESC">Harga (Termahal &gt; Termurah)</option>
                      <option value="total_rating-DESC">Rating (Tertinggi)</option>
                      <option value="total_rating-ASC">Rating (Terendah)</option>
                    </select>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="dropdown">
                <input type="number" value="<?=$min;?>" class="form-control input-lg" placeholder="Harga Min">
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="dropdown">
                <input type="number" value="<?=$max;?>" class="form-control input-lg" placeholder="Harga Max">
              </div>
            </div>
            <button type="button" id="button-filter" class="btn_1">Terapkan</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /toolbox -->

    <div class="container margin_30">
    <div class="row small-gutters">
      <div class="col-6 col-md-4 col-xl-3">
        <div class="grid_item">
          <?php
              foreach($productlist as $product) {
                  $tourl = $this->toolset->tourl($product->name_product);
                  if(empty($product->url_photo)) {
                      $url_photo = base_url("assets/moonstore/ms01")."/image/product/product8-8.jpg";
                  } else {
                      $url_photo = base_url("img/622x800/$product->url_photo");
                  }
              ?>
              <figure>
            <span class="ribbon off">Hot</span>
            <a href="<?=base_url("index.php/product/$product->id_product-$tourl");?>">
              <img class="img-fluid lazy" src="<?=$url_photo;?>" data-src="<?=$url_photo;?>" alt="<?=$product->name_product;?>" title="<?=$product->name_product;?>">
            </a>
          </figure>
          <div class="rating"><?=$this->toolset->rating($product->total_rating);?></div>
          <a href="<?=base_url("index.php/product/$product->id_product-$tourl");?>">
            <h3><?=$product->name_product;?></h3>
          </a>
          <div class="price_box">
            <span class="new_price"><?=$this->toolset->rupiah($product->price_product);?></span>
            <!-- <span class="old_price"><?=$this->toolset->rupiah($product->price_product);?></span> -->
          </div>
          <ul>
            <li>
              <a href="#0" class="tooltip-1 addtowishlist" data-csrf="<?=$this->security->get_csrf_hash();?>" data-id="<?=$product->id_product;?>" data-toggle="tooltip" data-placement="left" title="Tambah ke Favorit">
                <i class="ti-heart"></i><span>Tambah ke Favorit</span>
              </a>
            </li>
            <li>
              <a href="#0" class="tooltip-1 addtocart csrf" data-id="<?=$product->id_product;?>" data-csrf="<?=$this->security->get_csrf_hash();?>" data-toggle="tooltip" data-placement="left" title="Tambah ke Keranjang">
                <i class="ti-shopping-cart"></i><span>Tambah ke Keranjang</span>
              </a>
            </li>
          </ul>
          <div>
                        <div class="btn_add_to_cart">
                          <button type="button" style="width: 100%" data-id="<?=$product->id_product;?>" class="btn_1 csrf" title="Buy" data-csrf="<?=$this->security->get_csrf_hash();?>"> Tambah ke Keranjang </button>
                        </div>
                    </div>
          <?php } if(count($productlist) < 1) { ?>

                  <div class="text-center">Belum ada produk</div>
              <?php } ?>
        </div>
        <!-- /grid_item -->
      </div>        
    </div>
    <div class="pagination__wrapper">
      <ul class="pagination">
        <?=$paging;?>
      </ul>
    </div>
  </div>
</main>

<script>
    var sort = "<?=$sort;?>";
    if(sort != "") {
    $('#input-sort').val(sort);
    }

    $('#input-sort').on('change',function(){
        var sort = $(this).val();
        location.href = "<?=$sorturl;?>"+sort;
    });

    $('#button-filter').on('click',function(){
        var min = $('.min').val();
        var max = $('.max').val();

        location.href = "<?=$filterurl;?>"+min+"-"+max;
    });
</script>