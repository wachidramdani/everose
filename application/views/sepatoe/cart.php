<main class="bg_gray">
	<div class="container margin_30">
	<div class="page_header">
		<h1>Keranjang Belanja</h1>
		<small><i>* Klik icon refresh jika ada penambahan jumlah / kuantitas</i></small>
	</div>
	<!-- /page_header -->
	<table class="table table-striped cart-list">

		<?php
		$num = 0;
		foreach($cart['data'] as $cart) {
		    $num++;
		?>
		<thead>
			<tr>
				<th>Produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="thumb_cart">
						<img  src="<?=$cart['photo'];?>" data-src="<?=$cart['photo'];?>" class="lazy" alt="Image">
					</div>
					<span class="item_cart"><?=$cart['name'];?></span>
				</td>
				<td>
					<strong><?=$this->toolset->rupiah($cart['price']);?></strong>
				</td>
				<td>
					<input type="text" value="<?=$cart['qty'];?>" size="1" id="quantity" style="text-align: right;" name="quantity">
					<button class="btn btn-danger btn-update" title="" data-toggle="tooltip" type="button" data-original-title="Update" data-id="<?=$cart['id'];?>"> &#x21bb; </button>
					<button class="btn btn-danger btn-remove" title="" data-toggle="tooltip" type="button" data-original-title="Remove" data-id="<?=$cart['id'];?>"><i class="ti-trash"></i></button>
				</td>
				<td>
					<strong><?=$this->toolset->rupiah($cart['sub']);?></strong>
				</td>
			</tr>
			<?php 
			}
			if($num == 0) {
			?>
				<td colspan="6" style="text-align: center"><b>Keranjang masih kosong</b></td>
			<?php } ?>
		</tbody>
	</table>
	
	<div class="box_cart">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-xl-4 col-lg-4 col-md-6">
					<?php if($total['total'] == 0) {
						echo '';
					?>
										
					<?php }else{
						echo '<ul>
								<li>
									<span>Total</span>'.$this->toolset->rupiah($total['total']).'
								</li>
								</ul>
								<a href="transaction/checkout" class="btn_1 full-width cart">Lakukan Pembayaran</a>';
					}?>
				</div>
			</div>
		</div>
	</div>
	<!-- /box_cart -->
	
</main>
<script>
$('.btn-update').on('click',function(){
var id = $(this).attr("data-id");
var qty = $("#quantity").val();
    $.ajax({
            url: "<?=base_url("index.php/cart/add/");?>",
            method: "POST",
            data: {
                "id": id,
                "qty": qty,
                "update": "yes",
                "<?=$this->security->get_csrf_token_name();?>": "<?=$this->security->get_csrf_hash();?>"
            },
            dataType: "json",
            success:function(result){
                location.reload(true);
            }
    });
});
$('.btn-remove').on('click',function(){
var id = $(this).attr("data-id");
    $.ajax({
            url: "<?=base_url("index.php/cart/delete");?>/",
            method: "POST",
            data: {
                "id": id,
                "<?=$this->security->get_csrf_token_name();?>": "<?=$this->security->get_csrf_hash();?>"
            },
            dataType: "json",
            success:function(result){
                location.reload(true);
            }
    });
});
</script>