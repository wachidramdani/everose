<!DOCTYPE HTML>
<html>
	<body>
			
		<table style='width: 100%; border: 1px solid'>
			<tr>
				<td colspan="3">
					<img style='margin: 20px; width: 150px' src='https://sepatoe.id/assets/vector/isolated-monochrome-black.svg'>
				</td>
				<td align="center"><?=$kurir;?></td>
			</tr>
			<?php
				$no= 0;
				foreach($cetak as $print){
				$no++
			?>
			<tr align="center">
				<td colspan="4" height="30"><hr style="background-color: #303030"><b>Label Pengiriman</b><hr style="background-color: #303030"></td>
			</tr>
			<tr>
				<td style="width: 20%">Nama Penerima</td>
				<td>:</td>
				<td><b><?=$print->name_invoice?></b></td>
			</tr>
			<tr>
				<td style="width: 20%">No. Handphone</td>
				<td>:</td>
				<td><b><?=$print->hp_invoice?></b></td>
			</tr>
			<tr>
				<td style="width: 20%">Alamat</td>
				<td>:</td>
				<td><b><?=$print->address_invoice?></b></td>
			</tr>
			<tr>
				<td style="width: 20%">Tanggal Order</td>
				<td>:</td>
				<td><b><?=$print->date_invoice?></b></td>
			</tr>
			<tr>
				<td height="40"></td>
			</tr>
		</table>
		<table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
			<tr align="center">
				<td style="border: 1px solid black;"><b>No</b></td>
				<td style="width: 85%; border: 1px solid black;"><b>Nama Produk</b></td>
				<td style="border: 1px solid black;"><b>Jumlah</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;" align="center"><?=$no;?></td>
				<td style="width: 15%; border: 1px solid black;"><?=$print->product_detail?></td>
				<td style="border: 1px solid black;" align="right"><?=$print->qty_detail?></td>
			</tr>
		</table><br>
		Terima kasih sudah berbelanja di toko kami.<br>
		Barang yang sudah dibeli tidak dapat dikembalikan atau di uangkan kembali.
		<hr>
	<?php } ?>
	</body>
</html>