<main class="bg_gray">
	<div class="row justify-content-center">
		<div class="col-xl-6 col-lg-6 col-md-8">
			<div class="box_account" style="margin: 20px">
				<div class="form_container">
					<h5>Sign In</h5><hr><br>
					<form action="<?=base_url('index.php/admin/auth/login');?>" method="post" id="formLogin">
						<div class="form-group">
							<input type="number" class="form-control" name="handphone" id="handphone" placeholder="* No. Handphone">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password_in" id="password_in" value="" placeholder="Password*">
						</div>
						<div class="clearfix add_bottom_15">
							<div class="checkboxes float-left">
								<label class="container_check">Ingat saya
									<input type="checkbox" checked="checked">
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="float-right"><a id="forgot" href="javascript:void(0);">Lupa Password?</a></div>
						</div>
						<div><a href="<?=base_url()?>index.php/account/register">Create an Account?</a></div><br>
						<div class="text-center">
							<button type="button" class="btn_1 full-width btn-auth">Sign In</button>
						</div>
					</form>
					<div id="forgot_pw">
						<p style="text-align: center;">Link ganti password akan dikirim ke email anda.</p>
						<div class="form-group">
							<input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Masukan email anda">
						</div>
						<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script>
	$('.btn-auth').on('click',function(){
	  $.ajax({
	        url: "<?=base_url('index.php/account/login');?>",
	        method: "POST",
	        data: new FormData($('#formLogin')[0]),
	        contentType: false,
	        cache: false,
	        processData: false,
	        dataType: "json",
	        success:function(result){
	          if(result['status']) {
	          	alert('Berhasil login.');
	            location.href = "<?=base_url('index.php/Home');?>";
	          } else {
	            alert('No. Handphone atau Password salah.');
	          }
	        }
	      });
	});
</script>