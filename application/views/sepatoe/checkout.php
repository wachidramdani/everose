<main class="bg_gray">
	<div class="container margin_30">
		<div class="page_header">
			<h1>Proses Pembayaran</h1>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<form action="<?=base_url("index.php/transaction/payment");?>" method="post" id="formPayment">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="" data-csrf="<?=$this->security->get_csrf_hash();?>" class="csrf" id="csrf-form">
	        	<input type="hidden" name="courier_invoice" id="courier-form" value="">
				<div class="step first">
					<!-- <?php
					foreach($user_info as $user_info) {
					?> -->
					<h3>1. Informasi Pembeli dan Pengiriman</h3>
					<div class="checkout">
						<div class="tab-pane fade show active box_contacts">
							<div class="form-group">
								<input type="text" class="form-control" name="name_invoice" placeholder="Nama Lengkap" value="<?=$user_info->namalengkap;?>">
							</div>
							<div class="form-group">
								<input type="number" class="form-control" placeholder="Nomor Handphone" value="<?=$user_info->nohandphone;?>" name="hp_invoice">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Email" name="email_invoice" value="<?=$user_info->email;?>">
							</div>
							<div class="form-group">
								<textarea class="form-control" name="alamat" placeholder="Alamat Lengkap"><?=$user_info->alamat;?></textarea>
							</div>
							<div>
								<select name="provinsi" class="form-control province csrf" data-csrf="<?=$this->security->get_csrf_hash();?>">
			                        <option value="">--- Pilih ---</option>
			                        <?php
			                        foreach($province['rajaongkir']['results'] as $prv) {
			                        ?>

			                        <option value="<?=$prv['province_id'];?>"><?=$prv['province'];?></option>
			                        <?php } ?>

			                    </select>
			                    <div class="form-group">
			                        <label></label> 
			                        <select name="kota" class="form-control city csrf" data-csrf="<?=$this->security->get_csrf_hash();?>" disabled>
			                            <option value="">-- Pilih Kota/Kabupaten --</option>
			                        </select>
			                    </div>
							</div>
							<div class="form-group">
								<input type="text" name="kecamatan" data-csrf="kecamatan" class="form-control kecamatan" placeholder="Masukan Kecamatan" disabled="disabled">
							</div>
							<div class="form-group">
								<input type="text" name="pos" class="form-control pos" placeholder="Masukan Kode Pos" disabled="disabled">
							</div>
						</div>
					</div>
					<!-- <?php } ?> -->
				</div>
			</form>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="step middle payments">
					<h3>2. Metode Pengiriman</h3>
					<div class="box_general summary">
						<p>* Pilih Kurir dibawah ini</p>
						<div id="shipping" class="panel courier"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="step last">
					<h3>3. Detail & Biaya Pesanan</h3>
					<div class="box_general summary">
						<?php
						$num = 0;
						foreach($cart['data'] as $cart) {
						    $num++;
						?>
						<ul>
							<li class="clearfix"><em><?=$cart['name'];?> (<?=$cart['qty'];?>x)</em> <span><?=$this->toolset->rupiah($cart['price']);?></span></li>
						</ul>
						<?php 
						}
						if($num == 0) {
						?>
							<ul>
								<li class="clearfix"><em>Produk yang anda beli tidak ada. <a href="<?php base_url('index.php/home');?>">Beli Sekarang?</a></span></li>
							</ul>
						<?php } ?>
						<ul>
							<li class="clearfix"><em><strong>Subtotal</strong></em>  <span><?=$this->toolset->rupiah($total['total']);?></span></li>								
						</ul>
						<b>Total</b>
						<div class="total clearfix" style="text-align: right; font-size: 20px"></div>
						<button class="btn_1 full-width" id="button-confirm" style="margin-top: 20px">Lakukan Pembayaran</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	$('#button-confirm').on('click',function(){
	    var csrf = $('#csrf-form').attr("data-csrf");
	    $('#csrf-form').val(csrf);
	    //var form = new FormData($('#formPayment')[0]);
	    $.ajax({
	        url: "<?=base_url('index.php/transaction/verification');?>",
	        method: "POST",
	        data: new FormData($('#formPayment')[0]),
	        contentType: false,
	        cache: false,
	        processData: false,
	        dataType: "json",
	        success:function(result){
	            $('.csrf').attr('data-csrf',result['csrf_regenerate']);
	            $('#csrf-form').val(result['csrf_regenerate']);
	            if(result['status']) {
	                $('body').append('<div style="width:100%;height:100%;position:fixed;z-index:99;top:0;left:0;background:rgba(0,0,0,0.8);display:flex;justify-content:center;align-items:center;flex-flow:column wrap"><div class="lds-dual-ring"></div><div style="display:block;font-size:16px;fonw-weight:bold">Harap Tunggu...</div></div>');
	                $("#formPayment").submit();
	            } else {
	                var msg = result['error'][0]['field']+" "+result['error'][0]['msg'];

	                Swal.fire(
	                    'Gagal',
	                    msg,
	                    'error'
	                )
	            }
	        }
	    });
	});

	$('body').on('click','.courier-item .link',function(){
	    var courier = $(this).attr("courier-id");
	    $('#courier-form').val(courier);
	    $('.courier-item .link').attr("style","border:none");
	    $(this).attr("style","border:1px solid #3085d6");
	    var total = $(this).attr("data-total");
	    var shipping = $(this).attr("data-shipping");
	    $('.shipping').html(shipping);
	    $('.total').html(total);
	});
	$('body').on('change','.province',function(){
	    var csrf = $(this).attr("data-csrf");
	    var key = $(".province").val();
	    $.ajax({
	            url: "<?=base_url('index.php/json/get_city');?>",
	            method: "POST",
	            data: {
	                "key": key,
	                "<?=$this->security->get_csrf_token_name();?>": csrf
	            },
	            dataType: "json",
	            success:function(result){
	                $('.csrf').attr("data-csrf",result['csrf_regenerate']);
	                $('.city').prop("disabled",false);
	                $('.city').html('<option value="">--- Pilih ---</option>');
	                $('.city').prop('selectedIndex',0);
	                $.each(result['rajaongkir']['results'],function(){
	                    $('.city').append('<option value="'+this.city_id+'">'+this.type+' '+this.city_name+'</option>');
	                });
	            }
	    });
	});
	$('body').on('change','.city',function(){
	    var csrf = $(this).attr("data-csrf");
	    var key = $('.city').val();
	    $('.kecamatan').prop("disabled",false);
	    $('.pos').prop("disabled",false);
	    $.ajax({
	            url: "<?=base_url('index.php/json/sum_shipping');?>",
	            method: "POST",
	            data: {
	                "destination": key,
	                "<?=$this->security->get_csrf_token_name();?>": csrf
	            },
	            dataType: "json",
	            success:function(result){
	                $('.csrf').attr("data-csrf",result['csrf_regenerate']);
	                $('.courier').html("");
	                $.each(result['results'],function(){
	                    $('#courier-form').val("");
	                    $('.courier').append('<div class="courier-item"><button type="button" class="link" data-shipping="'+this.shipping+'" data-total="'+this.total+'" courier-id="'+this.id+'"></button><table class="table table-bordered"><tr><td width="80px"><img src="<?=base_url("upload/ekspedisi");?>/'+this.courier+'.png" style="max-width:100%"/></td><td><div style="display:flex;align-items:center"><div style="width:45%">'+this.courier+' '+this.service+'<br>'+this.etd+' hari</div><div style="margin-left:auto;margin-right:12px;font-size:15px">'+this.shipping+'</div></div></td></tr></table></div>');
	                });
	            }
	    });
	});
</script>