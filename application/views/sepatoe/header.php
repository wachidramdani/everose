<?php
if(!isset($pagetitle)) {
    $pagetitle = $this->shop_setting->sitename();
}

$this->visitor->hit();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title><?=$pagetitle;?></title>

    <!-- Favicons-->
	<link rel="icon" type="image/png" href="//files.sirclocdn.xyz/everose-skincare/files/Logo%20everose%20%28small%29%20.png">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?=base_url();?>assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?=base_url();?>assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?=base_url();?>assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?=base_url();?>assets/img/apple-touch-icon-144x144-precomposed.png">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/home_1.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/custom.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/account.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/product_page.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/error_track.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/contact.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/cart.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/checkout.css" rel="stylesheet">
    <script src="<?=base_url();?>assets/adminlte/plugins/pace-progress/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/bayar.js"></script>
    <link href="<?=base_url();?>assets/css/listing.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/faq.css" rel="stylesheet">
    <script>
	    paceOptions = {
	    restartOnRequestAfter: 5,
	    ajax: {
	      trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
	    }
	  }
	</script>
	<style>.table-bordered,.table-bordered th,.table-bordered td {border-color:#aaa!important} .cartul li {list-style:none} .swal2-popup { font-size: 1.6rem !important; } .courier-item {position:relative;display:inline-block;width:100%} .courier-item .table {margin:0} .courier-item .link {position:absolute;top:0;left:0;width:100%;height:100%;background:transparent} .courier-item .link:hover { border: 1px solid #3085d6!important } .payment {padding:9px;margin:0;border:1px solid #aaa} .payment-cell {margin:9px 0;padding:9px 5px;border-bottom:1px dashed #ddd} .payment-cell:last-child {border:none} .payment-cell span { color: #000;font-size:15px;word-wrap:break-word } .lds-dual-ring { display: inline-block;width: 80px;height: 80px; } .lds-dual-ring:after { content: " ";display: block;width: 64px;height: 64px;margin: 8px;border-radius: 50%;border:6px solid #cef;border-color: #cef transparent #cef transparent;animation: lds-dual-ring 1.2s linear infinite; } @keyframes lds-dual-ring {0% {transform: rotate(0deg);} 100% {transform: rotate(360deg); } } #review-list {margin-bottom:22px;} .review-wrapper {border:1px solid #aaa;margin:12px 0;padding:5px;} .review-head {background:#FFF;margin:0;padding: 12px;border-bottom:1px solid #aaa;display:flex;justify-content:space-between;flex-wrap:wrap} .review-head .name {display:block;font-size:16px;color:#333} .review-body {margin:0;padding: 12px}</style>

	<style>
		.cardd {
		  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		  transition: 0.3s;
		  width: 70%;
		}

		.cardd:hover {
		  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
		}

		.container {
		  padding: 2px 16px;
		}
	</style>
</head>

<body>
	
<div id="page">
	
<header class="version_2">
	<div class="layer"></div><!-- Mobile menu overlay mask -->
	<div class="main_header">
		<div class="container">
			<div class="row small-gutters" style="background-color: #303030"></div>
			<div class="row small-gutters">
				<div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
					<div id="logo" style="padding: 4px;
						margin-left: 500px;
						height: 70px;
						width: 120px;
						margin-top: 20px;">
						<a href="/"><img src="<?=base_url('assets/logo.png');?>" alt="" width="100" height="50"></a>
					</div>
				</div>
				<nav class="col-xl-6 col-lg-7">
					<a class="open_close" href="javascript:void(0);">
						<div class="hamburger hamburger--spin">
							<div class="hamburger-box">
								<div class="hamburger-inner"></div>
							</div>
						</div>
					</a>
					<!-- Mobile menu button -->
					<div class="main-menu">
						<div id="header_menu">
							<a href="<?= base_url(); ?>"><img src="<?=base_url();?>assets/vector/isolated-monochrome-black.svg" alt="" width="200" height="115"></a>
							<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
						</div>
						<!-- <ul>
							<li>
								<a href="<?= base_url(); ?>" class="show-submenu">Home</a>
							</li>
							<?php
					        foreach($pages as $page) {
					        ?>

					        <li><a href="<?=base_url("page/$page->url_page");?>" class="parent"><?=$page->title_page;?></a> </li>

					        <?php } ?>
							<li><a href="<?=base_url('tracking');?>" title="Status Pesanan">Shop</a></li>
							<li><a href="<?=base_url();?>" title="Bantuan">What's New</a></li>
							<li><a href="<?=base_url('home/contact');?>" title="Bantuan">Sale</a></li>
							<li><a href="<?=base_url('home/contact');?>" title="Bantuan">News</a></li>
						</ul> -->
					</div>
					<!--/main-menu -->
				</nav>
				<!-- <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
					<a class="phone_top" href="tel://628123456789"><strong><span>Butuh Bantuan?</span>+62 123456789</strong></a>
				</div> -->
			</div>
			<!-- /row -->
		</div>
	</div>
	<!-- /main_header -->

	<div class="main_nav Sticky">
		<div class="container">
			<div class="row small-gutters">
				<div class="col-xl-3 col-lg-3 col-md-3">
					<nav class="categories">
						<ul class="clearfix">
							<li><span>
									<a href="#">
										<span class="hamburger hamburger--spin">
											<span class="hamburger-box">
												<span class="hamburger-inner"></span>
											</span>
										</span>
										Kategori
									</a>
								</span>
								<div id="menu">
									<ul>
										<?php
								            foreach($categories as $category) {
								            ?>  

								            <li><a href="<?=base_url("index.php/category/$category->id_category-".$this->toolset->tourl($category->name_category));?>"><?=$category->name_category;?></a></li>
							            <?php
							            }
							            ?>
									</ul>
								</div>
							</li>
						</ul>
					</nav>
				</div>
				<div class="main-menu">
					<div id="header_menu">
						<a href="<?= base_url(); ?>"><img src="<?=base_url();?>assets/vector/isolated-monochrome-black.svg" alt="" width="200" height="115"></a>
						<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
					</div>
					<ul>
						<li>
							<a href="<?= base_url(); ?>" class="show-submenu">Home</a>
						</li>
						<?php
						foreach($pages as $page) {
						?>

						<li><a href="<?=base_url("page/$page->url_page");?>" class="parent"><?=$page->title_page;?></a> </li>

						<?php } ?>
						<li><a href="<?=base_url('tracking');?>" title="Status Pesanan">Shop</a></li>
						<li><a href="<?=base_url();?>" title="Bantuan">What's New</a></li>
						<li><a href="<?=base_url('home/contact');?>" title="Bantuan">Sale</a></li>
						<li><a href="<?=base_url('home/contact');?>" title="Bantuan">News</a></li>
					</ul>
				</div>
				<!-- <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
					<div class="custom-search-input">							
						<form action="<?=base_url('index.php/search');?>" method="get">
				          <input type="text" name="q" value="<?php if(isset($q)) echo $q;?>" placeholder="Tulis sesuatu...." class="form-control input-lg" />
				          <span class="input-group-btn">
				          <button type="submit"><i class="header-icon_search_custom"></i></button>
				          </span>
				         </form>
					</div>
				</div> -->
				<div class="col-xl-3 col-lg-2 col-md-3">
					<ul class="top_tools">
						<li>
							<div id="cart" class="dropdown dropdown-cart">
								<a href="<?=base_url("index.php/cart");?>" class="cart_bt crtitem crttotal"><strong><?=count($cart['data']);?></strong></a>
								<div class="dropdown-menu cartul">
									<ul>
										<?php foreach($cart['data'] as $crt) { ?>
										<li>
											<a href="<?=$crt['photo'];?>">
												<figure><img class="img-thumbnail" title="<?=$crt['name'];?>" alt="<?=$crt['name'];?>" src="<?=$crt['photo'];?>" style="max-width:30px"></figure>
												<strong><span><?=$crt['qty'];?>x <?=$crt['name'];?></span><?=$this->toolset->rupiah($crt['sub']);?></strong>
											</a>
											<a class="action deletecart csrf" data-csrf="<?=$this->security->get_csrf_hash();?>" title="Remove" type="button" data-id="<?=$crt['id'];?>"><i class="ti-trash"></i></a>
										</li>
										<?php
								          }
								          if(count($cart['data']) < 1) { 
								        ?>
								        <li style="text-align: center;margin-bottom: 12px" class="nullcart">Keranjang masih kosong</li>

      									<?php } else { ?>
      										<div class="total_drop">
												<div class="clearfix"><strong>Total</strong><span><?=$this->toolset->rupiah($cart['total']);?></span></div>
												<a href="<?=base_url("index.php/cart");?>" class="btn_1 outline">Lihat Keranjang</a><a href="<?=base_url("index.php/transaction/checkout");?>" class="btn_1">Lakukan Pembayaran</a>
											</div>
										<?php } ?>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="#0" class="wishlist"><span>Wishlist</span></a>
						</li>
						<li>
							<div class="dropdown dropdown-access ">
								<a href="<?=base_url('index.php/account');?>" class="access_link "><span>Account</span></a>
								<div class="dropdown-menu">
									<?php
										if(isset($user_info['namalengkap'])){
											echo $user_info['namalengkap'];
											echo '<br>';
											echo $user_info['email'];
											echo '<br>';
											echo $user_info['nohandphone'];
											echo '<a href="" style="background-color: #92c16f; text-align: center; padding: 5px; border-radius: 3px">Lihat Profil</a>';
									?>		
									<?php }else{ ?>
										<a href="<?=base_url('index.php/account');?>" class="btn_1">Masuk atau Daftar</a>
									<?php } ?>
									
									<ul>
										<li>
											<a href="<?=base_url();?>index.php/tracking"><i class="ti-truck"></i>Lacak Pesanan</a>
										</li>
										<?php
										if(!isset($user_info['namalengkap'])){
											echo '';
										?>		
										<?php }else{ ?>
											<li>
												<a href="<?=base_url();?>index.php/cart/myorder"><i class="ti-package"></i>Pesananku</a>
											</li>
										<?php } ?>
										<?php
										if(!isset($user_info['namalengkap'])){
											echo '';
										?>		
										<?php }else{ ?>
											<li>
												<a href="<?=base_url();?>index.php/cart/wishlist"><i class="ti-heart"></i>Produk Favorit</a>
											</li>
										<?php } ?>
										<li>
											<a href="help.html"><i class="ti-help-alt"></i>Bantuan</a>
										</li>
										<?php
										if(!isset($user_info['namalengkap'])){
											echo '';
										?>		
										<?php }else{ ?>
											<li>
												<a href="<?=base_url('index.php/account/logout');?>"><i class="ti-close"></i> Keluar</a>
											</li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<!-- /dropdown-access-->
						</li>
						<li>
							<a href="javascript:void(0);" class="btn_search_mob"><span>Cari Produk</span></a>
						</li>
						<li>
							<a href="#menu" class="btn_cat_mob" >
								<div class="hamburger hamburger--spin" id="hamburger">
									<div class="hamburger-box">
										<div class="hamburger-inner"></div>
									</div>
								</div>
								Kategori
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /row -->
		</div>
		<div class="search_mob_wp">
			<form action="<?=base_url('index.php/search');?>" method="get">
	          <input type="text" name="q" value="<?php if(isset($q)) echo $q;?>" placeholder="Tulis sesuatu...." class="form-control"/>
	          <span class="input-group-btn">
	          <input type="submit" class="btn_1 full-width" value="Cari Produk">
	          </span>
	        </form>
		</div>
		<!-- /search_mobile -->
	</div>
	<!-- /main_nav -->
</header>
		