<main class="bg_gray">
	<div class="row justify-content-center">
		<div class="col-xl-6 col-lg-6 col-md-8">
			<?php echo $this->session->flashdata('gagal'); ?>
			<div class="box_account" style="margin: 20px">
				<div class="form_container">
					<form action="<?php echo base_url(); ?>account/adduser" method="POST" enctype="multipart/form-data">
						<span class="action"></span><h5>Buat Akun</h5> <hr><br>
						<div class="form-group">
							<input type="text" class="form-control validate get" name="namadepan" placeholder="Nama Depan*">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control validate get" name="namabelakang" placeholder="Nama Belakang*">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<input type="email" class="form-control validate get" name="email" id="email" placeholder="Email*">
							<div class="invalid-feedback"></div>
						</div>
						<hr>
						<div class="form-group">
							<input type="number" class="form-control validate get" name="nohandphone" placeholder="Nomor Handphone*">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control validate get" name="password" value="" placeholder="Password*">
							<div class="invalid-feedback"></div>
						</div>
						<hr>
						<div class="private box">
							<div class="row no-gutters">
								
								<div class="col-12">
									<div class="form-group">
										<textarea class="form-control validate get" name="alamat" placeholder="Alamat Lengkap*"></textarea>
										<div class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<select name="provinsi" id="provinsi" class="form-control validate get csrf" data-csrf="<?=$this->security->get_csrf_hash();?>" name="provinsi">
		                            <option value="0">--- Pilih Provinsi ---</option>
		                            <?php
		                            foreach($province['rajaongkir']['results'] as $prv) {
		                            ?>

		                            <option value="<?=$prv['province_id'];?>"><?=$prv['province'];?></option>
		                            <?php } ?>
								</select>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group">
		                        <select name="kota" id="kota" class="form-control city csrf" onchange="loadKecamatan()" data-csrf="<?=$this->security->get_csrf_hash();?>" disabled>
		                            <option value="">-- Pilih Kota/Kabupaten --</option>
		                        </select>
		                    </div>
		                    <p><div id="kecamatanArea"></div></p>
							<div class="form-group">
								<input type="number" class="form-control" name="kodepos" placeholder="Kodepos*">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<p style="font-size: 12px">* Digunakan untuk alamat pengiriman</p>
						<hr>
						<div class="form-group">
							<label class="container_check">Setuju <a href="#0">Kebijakan dan Privasi</a>
								<input type="checkbox" checked="checked">
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="text-center" style="margin-top: 20px"><input type="submit" value="Register" class="btn_1 full-width"></div>
					</form>
				</div>
				<!-- /form_container -->
			</div>
			<!-- /box_account -->
		</div>
	</div>
	<!-- /row -->
	</div>
	<!-- /container -->
</main>
<script src="<?=base_url();?>assets/js/common_scripts.min.js"></script>
<script src="<?=base_url();?>assets/js/main.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="<?=base_url();?>assets/js/carousel-home.js"></script>


<script src="<?=base_url("assets/moonstore/ms01/javascript/jquery.parallax.js");?>"></script> 
<script src="<?=base_url();?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$('body').on('change','#provinsi',function(){
    var csrf = $(this).attr("data-csrf");
    var key = $("#provinsi").val();
    $.ajax({
            url: "<?=base_url("json/get_city");?>",
            method: "POST",
            data: {
                "key": key,
                "<?=$this->security->get_csrf_token_name();?>": csrf
            },
            dataType: "json",
            success:function(result){
                $('.csrf').attr("data-csrf",result['csrf_regenerate']);
                $('.city').prop("disabled",false);
                $('.city').html('<option value="">--- Pilih Kota/Kabupaten---</option>');
                $('.city').prop('selectedIndex',0);
                $.each(result['rajaongkir']['results'],function(){
                    $('.city').append('<option value="'+this.city_id+'">'+this.type+' '+this.city_name+'</option>');
                });
            }
    });
});
function loadKecamatan()
{
    var kabupaten = $("#kota").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>index.php/account/kecamatan",
        data:"id=" + kabupaten,
        success: function(html)
        { 
            $("#kecamatanArea").html(html);
        }
    }); 
}
</script>