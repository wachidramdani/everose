<main class="bg_gray">
	<div class="container margin_30">
		<div class="page_header">
			<h1>Pesananku</h1>
		</div>

		<table class="table table-striped order">
			<thead>
				<th>Produk</th>
				<th>Harga</th>
				<th>Qty</th>
				<th>Subtotal</th>
				<th>Status</th>
			</thead>
			<tbody>
				<?php
				$num = 0;
				foreach($myorder as $myorder) {
				    $num++;
				?>
				<tr>
					<td><?=$myorder['name_product'];?></td>
					<td><?=$this->toolset->rupiah($myorder['price_detail']*$myorder['qty_detail']);?></td>
					<td><?=$myorder['qty_detail'];?> Produk</td>
					<td><?=$this->toolset->rupiah(($myorder['price_detail']*$myorder['qty_detail'])+$myorder['shipping_invoice']);?></td>
					<td>
						<?php 
						 	if($myorder["status_invoice"] == 1){
						 		echo '<span style="background-color: #f52200; color: white; border-radius: 5px; padding: 3px">Belum dibayar</span>';
						?>

						<?php }else if($myorder["status_invoice"] == 2){
								echo '<span style="background-color: #00b1f5; color: white; border-radius: 5px; padding: 3px">Sudah dibayar</span>';
						?>
						<?php }else if($myorder["status_invoice"] == 3){
								echo '<span style="background-color: #c3c3c3; color: white; border-radius: 5px; padding: 3px">Dikemas</span>';
						?>
						<?php }else if($myorder["status_invoice"] == 4){
								echo '<span style="background-color: #0369e7; color: white; border-radius: 5px; padding: 3px">Dikirim</span>';
						?>
						<?php }else{
								echo '<span style="background-color: #04bb23c2; color: white; border-radius: 5px; padding: 3px">Selesai</span>';
						?>
						<?php } ?>
					</td>
				</tr>
				<?php 
				}
				if($num == 0) {
				?>
					<td colspan="6" style="text-align: center"><b>Pesanan masih kosong</b></td>
				<?php } ?>
			</tbody>
		</table>
	</div>
</main>
<script>
$('.btn-update').on('click',function(){
var id = $(this).attr("data-id");
var qty = $(this).parent().parent().children(".quantity").val();
    $.ajax({
            url: "<?=base_url("cart/add");?>/",
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
            url: "<?=base_url("cart/delete");?>/",
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