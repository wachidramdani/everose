<main>
	<form id="formComment">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="" data-csrf="<?=$this->security->get_csrf_hash();?>" id="csrf-form" class="csrf">
        <div id="review"></div>
		<div class="container margin_60_35">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="write_review">
						<h1>Tulis Ulasan</h1>
						<div class="rating_submit">
							<div class="form-group">
							<label class="d-block">Kepuasan</label>
							<span class="rating mb-0">
								<input type="radio" class="rating-input" id="5_star" name="rating_comment" value="5 Stars"><label for="5_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="4_star" name="rating_comment" value="4 Stars"><label for="4_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="3_star" name="rating_comment" value="3 Stars"><label for="3_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="2_star" name="rating_comment" value="2 Stars"><label for="2_star" class="rating-star"></label>
								<input type="radio" class="rating-input" id="1_star" name="rating_comment" value="1 Star"><label for="1_star" class="rating-star"></label>
							</span>
							</div>
						</div>
						<!-- /rating_submit -->
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="name_comment" value="" id="input-name" class="form-control" placeholder="Nama"/>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email_comment" value="" id="input-name" class="form-control" hidden/>
						</div>
						<div class="form-group">
							<label>Ulasan</label>
							<textarea name="body_comment" rows="5" id="input-review" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Add your photo (optional)</label>
							<div class="fileupload"><input type="file" name="fileupload" accept="image/*"></div>
						</div>
						<div class="form-group">
							<div class="checkboxes float-left add_bottom_15 add_top_15">
								<label class="container_check">Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</div>
						</div>
						<button type="button" id="send-comment" data-loading-text="Loading..." class="btn_1">Kirim Ulasan</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</main>