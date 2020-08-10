<main class="bg_gray">
	<div id="track_order">
		<div class="container">
			<div class="row justify-content-center text-center">
				<div class="col-xl-7 col-lg-9">
					<img src="<?= base_url('assets/img/track_order.svg'); ?>" alt="" class="img-fluid add_bottom_15" width="200" height="177" style="margin-top: 30px">
					<p>Lacak Pesanan Anda..</p>
					<form action="<?=base_url('tracking/order');?>/" method="post" id="form-tracking">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
						<div class="search_bar">
							<input type="text" placeholder="Masukan Nomor Pesanan" name="no_invoice" class="form-control" id="orderid" value="<?=$this->session->order_id;?>">
							<input type="submit" value="Lacak" id="button-confirm" data-loading-text="Loading...">
						</div>
					</form>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /track_order -->
	
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
		                $url_photo = base_url("img/622x800/$product->url_photo");
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
	                    	<button type="button" data-id="<?=$product->id_product;?>" class="btn_1 csrf" title="Buy" data-csrf="<?=$this->security->get_csrf_hash();?>"> Buy </button>
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
