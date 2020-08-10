<?php
$explodeimg = explode(",",$detail->photo_product);
$bigthumb = $explodeimg[0];

$rowthumb = $explodeimg;
unset($rowthumb[0]);

?>
<main>
    <div class="container margin_30">
        <div class="row">
            <div class="col-md-4">
                <div class="all">
                    <div class="slider">
                        <div class="owl-carousel owl-theme main">
                            <div class="item-box">
                            	<img src="<?=base_url("upload/product/$bigthumb");?>" title="<?=$detail->name_product;?>" alt="<?=$detail->name_product;?>" />
                            </div>
                        </div>
                        <div class="left nonl"><i class="ti-angle-left"></i></div>
                        <div class="right"><i class="ti-angle-right"></i></div>
                    </div>
                    <div class="slider-two">
                        <div class="owl-carousel owl-theme thumbs">
                        	<?php
						    foreach($slidersproduct as $slider) {
						        $slider->url_photo = base_url("upload/product/$slider->url_photo");
						    ?>
                            <div class="item active">
                            	<img src="<?=$slider->url_photo;?>" title="<?=$slider->url_photo;?>" />
                            </div>
                            <?php
						    }
						    ?>
                        </div>
                        <div class="left-t nonl-t"></div>
                        <div class="right-t"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="prod_info">
                    <h1><?=$detail->name_product;?></h1>
                    <span class="rating"><?=$this->toolset->rating($detail->total_rating);?></span>
                    <p style="text-align: justify; text-justify: inter-word;"><?=nl2br($detail->description_product);?></p>
                    <div class="prod_options">
                        <div class="row">
                            <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Warna</strong></label>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                <?=$detail->warna;?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Ukuran</label>
                            <div class="col-xl-12 col-lg-5 col-md-6 col-6">
                                <?=$detail->size;?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Stok</strong></label>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                <?=$detail->stock_product;?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Jumlah</strong></label>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                <div class="numbers-row">
                                    <input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="price_main"><span class="new_price"><?=$this->toolset->rupiah($detail->price_product);?></span></div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="btn_add_to_cart">
                                <button class="btn_1 addtowishlist" data-csrf="<?=$this->security->get_csrf_hash();?>" data-id="<?=$detail->id_product;?>" style="width: 100%; background-color: #fefefe; border: 1px solid #303030; color: black; border-radius: 3px; margin-top: 10px"><i class="ti-heart"></i><span> Tambah ke Favorit</span></button>

                                <button type="button" data-id="<?=$detail->id_product;?>" class="btn_1 addtocart-btn addtocart csrf" title="Tambah ke Keranjang" data-csrf="<?=$this->security->get_csrf_hash();?>" style="width: 100%; margin-top: 10px">
                                    <i class="ti-shopping-cart"></i> TAMBAH KE KERANJANG 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /prod_info -->
                <div class="product_actions">
                    <ul>
                        <li>
                            <button class="addtocart" data-csrf="<?=$this->security->get_csrf_hash();?>" style="background-color: #fefefe; border: 1px solid #303030; color: black; border-radius: 3px"><i class="ti-heart"></i><span> Tambah ke Favorit</span></button>
                        </li>
                        <li>
                            <a href="#"><i class="ti-control-shuffle"></i><span>Add to Compare</span></a>
                        </li>
                    </ul>
                </div>
                <!-- /product_actions -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
    
    <div class="tabs_product">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Deskripsi</a>
                </li>
                <li class="nav-item">
                    <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Ulasan</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /tabs_product -->
    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                                Deskripsi
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <h3 style="font-weight: bold;">Detail Produk</h3>
                                    <p style="text-align: justify;"><?=nl2br($detail->description_product);?></p>
                                </div>
                                <div class="col-lg-5">
                                    <h3 style="font-weight: bold;">Spesifikasi Produk</h3>
                                    <p style="text-align: justify;"><?=nl2br($detail->description_product);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /TAB A -->
                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                                Ulasan (<?=count($comments);?>)
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                        <div class="card-body">
                            <div class="row justify-content-between">
                            	<?php
					              foreach($comments as $comment) {
					             ?>
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><?=$this->toolset->rating($comment->rating_comment);?></span>
                                            <em><?=$comment->date_comment;?></em>
                                        </div>
                                        <h4>"<?=$comment->name_comment;?>"</h4>
                                        <p><?=$comment->body_comment;?></p>
                                    </div>
                                </div>
                                <?php } if(count($comments) == 0) { echo '<p style="font-size: 14px; text-align: center; width: 100%">Belum ada ulasan</p>'; } ?>
                            </div>
                            <!-- /row -->
                            <p class="text-right"><a href="leave-review.html" class="btn_1">Ulas Sekarang?</a></p>
                        </div>
                        <!-- /card-body -->
                    </div>
                </div>
                <!-- /tab B -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->

    <div class="bg_white">
		<div class="container margin_60_35">
			<div class="main_title">
				<h2>Produk</h2>
				<!-- <span>Produk</span> -->
			</div>
			<div class="owl-carousel owl-theme products_carousel">
				<?php
		        foreach($productlist as $product) {
		            $tourl = $this->toolset->tourl($product->name_product);
		            if(empty($product->url_photo)) {
		                $url_photo = base_url("assets/moonstore/ms01")."/image/product/product8-8.jpg";
		            } else {
		                $url_photo = base_url("upload/product/$product->url_photo");
		            }
		        ?>
				<div class="item">
					<div class="grid_item">
						<span class="ribbon new">New</span>
						<figure>
							<a href="<?=base_url("product/$product->id_product-$tourl");?>">
								<img class="owl-lazy" style="width: 250px; height: 300px" src="<?=$url_photo;?>" data-src="<?=$url_photo;?>" alt="<?=$product->name_product;?>" title="<?=$product->name_product;?>">
							</a>
						</figure>
						<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
						<a href="product-detail-1.html">
							<h3><?=$product->name_product;?></h3>
						</a>
						<div class="price_box">
							<span class="new_price"><?= $product->price_product;?></span>
						</div>
						<div class="btn_add_to_cart">
	                    	<button type="button" data-id="<?=$product->id_product;?>" class="btn_1 csrf" title="Buy" data-csrf="<?=$this->security->get_csrf_hash();?>"> Beli </button>
	                    </div>
					</div>
					<!-- /grid_item -->
				</div>
				<?php
		        }
		        ?>
			</div>
		</div>
	</div>

</main>