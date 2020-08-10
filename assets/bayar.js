$('#button-confirm').on('click',function(){
    var csrf = $('#csrf-form').attr("data-csrf");
    $('#csrf-form').val(csrf);
    $.ajax({
        url: "<?=base_url('transaction/verification');?>",
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
            url: "<?=base_url('json/get_city');?>",
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
    $.ajax({
            url: "<?=base_url('json/sum_shipping');?>",
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