<html>
<head>
  <style>
    @page { margin: 100px 40px; }
    header { position: fixed; top: -60px; left: 0px; right: 0px; height: 120px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; }
    main { margin: 0;}
    body{ padding: 80px 0 0 0;}
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .page_break { page-break-before: always; }
    .page_number:after { content: counter(page,decimal);}
    table {
        border-collapse: collapse;
    }
    th,td {
        border: 1px solid #000;
        padding: 9px;
    }

    thead {
        background: #555;
        color: #FFF;
    }

    tfoot {
        background: #EEE;
    }
  </style>
  <title>LAPORAN PENJUALAN - RANGKUMAN</title>
</head>
<body>
  <header>
  <h1><center>LAPORAN PENJUALAN - RANGKUMAN</center></h1>
  <center><?=$range;?></center>
  </header>
  <footer><br>Halaman : <span class="page_number"></span></footer>
  <main>

    <table width="100%">
        <thead>
            <tr>
                <th style="width:15%">Tanggal</th>
                <th style="width:15%">Order ID</th>
                <th style="width:25%">Nama Pelanggan</th>
                <th style="width:15%">Total</th>
                <th style="width:15%">Ongkos Kirim</th>
                <th style="width:15%">Grand Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        $shipping = 0;
        $grand = 0;
        foreach($data as $field) {
            $total = $total + $field->total_invoice;
            $shipping = $shipping + $field->shipping_invoice;
            $grand = $grand + ($field->total_invoice + $field->shipping_invoice);
        ?>

            <tr>
                <td><?=$field->date_invoice;?></td>
                <td><?=$field->no_invoice;?></td>
                <td><?=$field->name_invoice;?></td>
                <td style="text-align:right"><?=$this->toolset->rupiah($field->total_invoice);?></td>
                <td style="text-align:right"><?=$this->toolset->rupiah($field->shipping_invoice);?></td>
                <td style="text-align:right"><?=$this->toolset->rupiah($field->total_invoice + $field->shipping_invoice);?></td>
            </tr>
        <?php } ?>

        </tbody>
        <tfoot>
            <tr>
                <th style="text-align:center" colspan="3">Total</th>
                <th style="text-align:right" class="total"><?=$this->toolset->rupiah($total);?></th>
                <th style="text-align:right" class="shipping"><?=$this->toolset->rupiah($shipping);?></th>
                <th style="text-align:right" class="grand"><?=$this->toolset->rupiah($grand);?></th>
            </tr>
        </tfoot>
    </table>

  </main>
</body>
</html>