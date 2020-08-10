<main class="bg_gray">
	<div class="container margin_30">
	<div class="page_header">
		<h1>Produk Favorit</h1>
	</div>
	<!-- /page_header -->
	<table class="table table-striped cart-list">
		<thead>
			<tr>
				<th>Produk</th>
				<th>Harga</th>
			</tr>
		</thead>
		<?php
		$num = 0;
		foreach($wishlist as $wish) {
		    $num++;
		?>
		<tbody>
			<tr>
				<td>
					<div class="thumb_cart">
						<img  src="<?=base_url("upload/product/".$wish['url_photo']);?>" data-src="<?=base_url("upload/product/".$wish['url_photo']);?>" class="lazy" alt="Image">
					</div>
					<span class="item_cart"><?=$wish['name_product'];?></span>
				</td>
				<td>
					<strong><?=$this->toolset->rupiah($wish['price_product']);?></strong>
				</td>
			</tr>
			<?php 
			}
			if($num == 0) {
			?>
				<td colspan="6" style="text-align: center"><b>Daftar favorit masih kosong</b></td>
			<?php } ?>
		</tbody>
	</table>
	
	
</main>