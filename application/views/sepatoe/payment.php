
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?=$clientkey;?>"></script>
<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
            <h1>Detail Checkout</h1>
        </div>

        <table class="table table-striped order">
            <tbody>
                <tr>
                    <td>Order ID</td>
                    <td>:</td>
                    <td><?=$dataorder['no_invoice'];?></td>
                </tr>
                <tr>
                    <td>Nama Pemesan</td>
                    <td>:</td>
                    <td><?=$dataorder['name_invoice'];?></td>
                </tr>
                <tr>
                    <td>No. Handphone</td>
                    <td>:</td>
                    <td><?=$dataorder['hp_invoice'];?></td>
                </tr>
                <tr>
                    <td>Email Pemesan</td>
                    <td>:</td>
                    <td><?=$dataorder['email_invoice'];?></td>
                </tr>
                <tr>
                    <td>Alamat Pengiriman</td>
                    <td>:</td>
                    <td><?=$dataorder['address_invoice'];?></td>
                </tr>
                <tr>
                    <td>Kurir Pengiriman</td>
                    <td>:</td>
                    <td><?=$dataorder['courier_invoice'];?></td>
                </tr>
                <tr>
                    <td>Grand Total</td>
                    <td>:</td>
                    <td><?=$this->toolset->rupiah($dataorder['total_invoice'] + $dataorder['shipping_invoice']);?></td>
                </tr>
                <tr>
                    <td>Tanggal Pemesanan</td>
                    <td>:</td>
                    <td><?=$dataorder['date_invoice'];?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="button" style="align-content: center; width: 100%" data-loading-text="Loading..." class="btn_1" id="pay-button" value="Pembayaran">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
<script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        snap.pay('<?=$dataorder['token_invoice'];?>', {
        })

      });
</script>