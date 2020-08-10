<?php
if(!isset($min)) {
    $min = "";
}
if(!isset($max)) {
    $max = "";
}
?>
<main>
    <div class="container margin_30">
      <div class="row">
          <aside class="col-lg-3" id="sidebar_fixed">
              <div class="filter_col">
                  <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                  <div class="filter_type version_2">
                      <h4><a href="#filter_1" data-toggle="collapse" class="opened">Harga</a></h4>
                      <div class="collapse show" id="filter_1">
                          <ul>
                              <li>
                                  <div class="col-lg-12 col-md-6 col-sm-6">
                                    <div class="dropdown">
                                      <input type="number" value="<?=$min;?>" class="form-control input-lg min" placeholder="Harga Min">
                                    </div>
                                  </div><br>
                                  <div class="col-lg-12 col-md-6 col-sm-6">
                                    <div class="dropdown">
                                      <input type="number" value="<?=$max;?>" class="form-control input-lg max" placeholder="Harga Max">
                                    </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                      <!-- /filter_type -->
                  </div>
                  <div class="buttons">
                      <button type="button" style="width: 100%" id="button-filter" class="btn_1">Terapkan</button>
                  </div>
              </div>
          </aside>
          <!-- /col -->
          <div class="col-lg-9">
              <!-- /top_banner -->
              <div id="stick_here"></div>
              <div class="toolbox elemento_stick add_bottom_30">
                  <div class="container">
                      <ul class="clearfix">
                          <li>
                              <div class="sort_select">
                                <select id="input-sort sort">
                                  <option value="id_product-DESC">Urut berdasarkan</option>
                                  <option value="name_product-ASC">Nama (A - Z)</option>
                                  <option value="name_product-DESC">Nama (Z - A)</option>
                                  <option value="price_product-ASC">Harga (Termurah &gt; Termahal)</option>
                                  <option value="price_product-DESC">Harga (Termahal &gt; Termurah)</option>
                                  <option value="total_rating-DESC">Rating (Tertinggi)</option>
                                  <option value="total_rating-ASC">Rating (Terendah)</option>
                                </select>
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="row small-gutters">
                <?php
                  foreach($productlist as $product) {
                    $tourl = $this->toolset->tourl($product->name_product);
                    if(empty($product->url_photo)) {
                        $url_photo = base_url("assets/moonstore/ms01")."/image/product/product8-8.jpg";
                    } else {
                        $url_photo = base_url("upload/product/$product->url_photo");
                    }
                ?>
                <div class="col-6 col-md-4 col-xl-3">
                  <div class="grid_item">
                    <figure>
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
                    </div><br>
                  </div>
                </div>
                <?php } if(count($productlist) < 1) { ?>
                    <div class="text-center">Belum ada produk</div>
                <?php } ?>
              </div>
            </div>
            <div class="pagination__wrapper">
              <ul class="pagination">
                <?=$paging;?>
              </ul>
            </div>
        </div>
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