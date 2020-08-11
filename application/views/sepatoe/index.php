<main>
	<div id="carousel-home" class="add_top_5">
		<div class="owl-carousel owl-theme">
			<?php
			    foreach($sliders as $slider) {
			        $slider->img_slider = base_url("upload/slider/$slider->img_slider");
			    ?>

			    <div class="item"> 
			    	<a href="<?=$slider->link_slider;?>">
			    	<img src="<?=$slider->img_slider;?>" alt="<?=$slider->title_slider;?>" class="img-responsive" />
			    	</a> 
			    	<div class="opacity-mask d-flex align-items-center">
						<div class="container">
							<div class="row justify-content-center justify-content-md-end">
								<div class="col-lg-6 static">
									<div class="slide-text text-right white">
										<!-- <h2 class="owl-slide-animated owl-slide-title"><?=$slider->title_slider;?></h2> -->
										<!-- <p class="owl-slide-animated owl-slide-subtitle">
											<?=$slider->desk_slider;?>
										</p> -->
										<!-- <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="listing-grid-1-full.html" role="button">Beli</a></div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
			    </div>

		    <?php
		    }
		    ?>
		</div>
		<div id="icon_drag_mobile"></div>
	</div>
	<!--/carousel-->

	<ul id="banners_grid" class="clearfix">
		<li>
			<a href="#0" class="img_container">
				<img src="img/banners_cat_placeholder.jpg" data-src="assets/img/banner_1.jpeg" alt="" class="lazy">
				<div class="short_info opacity-mask">
					<div><span class="btn_1">Beli</span></div>
				</div>
			</a>
		</li>
		<li>
			<a href="#0" class="img_container">
				<img src="img/banners_cat_placeholder.jpg" data-src="assets/img/banner_2.jpeg" alt="" class="lazy">
				<div class="short_info opacity-mask">
					<div><span class="btn_1">Beli</span></div>
				</div>
			</a>
		</li>
		<li>
			<a href="#0" class="img_container">
				<img src="img/banners_cat_placeholder.jpg" data-src="assets/img/banner_1.jpeg" alt="" class="lazy">
				<div class="short_info opacity-mask">
					<div><span class="btn_1">Beli</span></div>
				</div>
			</a>
		</li>
	</ul>
	<!--/banners_grid -->
	
	<div class="container margin_60_35">
		<div class="main_title">
			<h2 style="color: #ce5959;">Produk</h2>
			<!-- <span>Products</span>
			<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p> -->
		</div>
		
		<div class="row small-gutters">
			<?php
	        foreach($productlist as $product) {
	            $tourl = $this->toolset->tourl($product->name_product);
	            if(empty($product->url_photo)) {
	                $url_photo = base_url("assets/moonstore/ms01")."/image/product/product8-8.jpg";
	            } else {
	                $url_photo = base_url("img/622x800/$product->url_photo");
	            }
	        ?>	
			<div class="col-6 col-md-4 col-xl-3">
				<div class="grid_item">
					<figure>
						<span class="ribbon off">Hot</span>
						<a href="<?=base_url("product/$product->id_product-$tourl");?>">
							<img class="img-fluid lazy" src="<?=$url_photo;?>" data-src="<?=$url_photo;?>" alt="<?=$product->name_product;?>" title="<?=$product->name_product;?>">
							<img class="img-fluid lazy" src="<?=$url_photo;?>" data-src="<?=$url_photo;?>" alt="<?=$product->name_product;?>" title="<?=$product->name_product;?>">
						</a>
					</figure>
					<div class="rating"><?=$this->toolset->rating($product->total_rating);?></div>
					<a href="product-detail-1.html">
						<h3><?=$product->name_product;?></h3>
					</a>
					<div class="price_box">
						<span class="new_price"><?=$this->toolset->rupiah($product->price_product);?></span>
						<!-- <span class="old_price"><?=$this->toolset->rupiah($product->price_product);?></span> -->
					</div>
					<ul>
						<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
						<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
						<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
					</ul>
					<div>
                        <div class="btn_add_to_cart">
                        	<button type="button" style="width: 100%" data-id="<?=$product->id_product;?>" class="btn_1 csrf" title="Buy" data-csrf="<?=$this->security->get_csrf_hash();?>"> Beli </button>
                        </div>
                    </div>
				</div>
				<!-- /grid_item -->
			</div>
			<?php
	        }
	        ?>
		</div>
		
		<div style="overflow: hidden; text-align: center;">
          <a href="<?=base_url('catalog/?sort=total_rating-DESC');?>" class="btn_1"><span>Lihat Semua...</span></a>
        </div>
		<br></br>

		<!-- /row -->
	</div>
	<!-- /container -->

	<!-- <div class="featured lazy" data-bg="url(img/featured_home.jpg)">
		<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
			<div class="container margin_60">
				<div class="row justify-content-center justify-content-md-start">
					<div class="col-lg-6 wow" data-wow-offset="150">
						<h3>Armor<br>Air Color 720</h3>
						<p>Lightweight cushioning and durable support with a Phylon midsole</p>
						<div class="feat_text_block">
							<div class="price_box">
								<span class="new_price">$90.00</span>
								<span class="old_price">$170.00</span>
							</div>
							<a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- /featured -->

	<div>
		
	<img src="<?php echo base_url(); ?>assets/promo.jpg"> 
			
	</div>

	<br></br>
	<div class="container margin_60_35">
		<!-- <div class="main_title">
			<h2>Featured</h2>
			<span>Products</span>
			<p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
		</div> -->
		
		<div class="owl-carousel owl-theme products_carousel">
			<?php
	        foreach($productlist as $product) {
	            $tourl = $this->toolset->tourl($product->name_product);
	            if(empty($product->url_photo)) {
	                $url_photo = base_url("assets/moonstore/ms01")."/image/product/product8-8.jpg";
	            } else {
	                $url_photo = base_url("img/622x800/$product->url_photo");
	            }
	        ?>
			<div class="item">
				<div class="grid_item">
					<span class="ribbon new">New</span>
					<figure>
						<a href="<?=base_url("product/$product->id_product-$tourl");?>">
							<img class="owl-lazy" style="width: 300px; height: 300px" src="<?=$url_photo;?>" data-src="<?=$url_photo;?>" alt="<?=$product->name_product;?>" title="<?=$product->name_product;?>">
						</a>
					</figure>
					<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
					<a href="product-detail-1.html">
						<h3><?=$product->name_product;?></h3>
					</a>
					<div class="price_box">
						<span class="new_price"><?=$this->toolset->rupiah($product->price_product);?></span>
					</div>
					<ul>
						<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
						<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
						<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
					</ul>
					<div class="btn_add_to_cart">
                    	<button type="button" style="width: 100%" data-id="<?=$product->id_product;?>" class="btn_1 csrf" title="Buy" data-csrf="<?=$this->security->get_csrf_hash();?>"> Buy </button>
                    </div>
				</div>
				<!-- /grid_item -->
			</div>
			<?php
	        }
	        ?>
		</div>
	</div>
</main>