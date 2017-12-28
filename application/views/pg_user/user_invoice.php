<!DOCTYPE html>
<!-- saved from url=(0046)http://www.jonathantneal.com/examples/invoice/ -->
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style>article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}audio[controls],canvas,video{display:inline-block}[hidden],audio{display:none}mark{background:#FF0;color:#000}</style>
  <meta charset="utf-8">
  <title>Cetak Invoice</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/pg_user/css/invoice_style.css');?>">
  <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
  <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
</head>
<body>
  <header>
    <span><img alt="" src="<?php echo base_url('assets/pg_user/images/icon/Prime.png');?>" class=""></span>
    <address>
      <p>Jl. Magelang, No. 113, Yogyakarta, Indonesia</p>
      <p>(0274) 292 3430</p>
    </address>
  </header>

  <article>
    <h1>Recipient</h1>
    <address>
      <p>
        <?php echo $buy->nama_siswa;?> <br>
        <?php echo $buy->email ? "($buy->email)" : '';?>
      </p>
    </address>
    <table class="meta">
      <tbody>
        <tr>
          <th><span>Invoice #</span></th>
          <td><span><b><?php echo $buy->no_tagihan;?></b></span></td>
        </tr>
        <tr>
          <th><span>Tanggal Pembelian</span></th>
          <td><span><?php echo date('d M Y', strtotime($buy->timestamp));?></span></td>
        </tr>
        <tr>
          <th><span>Status</span></th>
          <td>
            <b>
            <?php
              if($buy->status == 0) { ?>  
                <span class="text-warning">Belum Lunas</span>
              <?php }
              elseif($buy->status == 1) { ?> 
                <span class="text-muted">Menunggu Konfirmasi</span>
              <?php }
              elseif($buy->status == 2){ ?> 
                <span class="text-success">Lunas</span>
              <?php }
              elseif($buy->status == 3){ ?> 
                <span class="text-danger">Dibatalkan</span>
              <?php }
            ?>
            </b>
          </td>
        </tr>
      </tbody>
    </table>

    <table class="inventory">
      <thead>
        <tr>
          <th><span>ID Produk</span></th>
          <th><span>Deskripsi Produk</span></th>
          <th><span>Harga Satuan</span></th>
          <th><span>Jumlah</span></th>
          <th><span>Total</span></th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($detail_pembelian as $item) 
        { ?>
        <tr>
          <td><span><?php echo $item->kode_paket;?></span></td>
          <td><span>Paket <?php echo ($item->tipe == 0) ? 'Reguler' : 'Premium'?> <?php echo $item->durasi;?> Bulan</span></td>
          <td><span class="pull-left">Rp</span><span class="pull-right"><?php echo number_format($item->harga_satuan);?>-</span></td>
          <td><span><?php echo $item->jumlah;?></span></td>
          <td><span class="pull-left">Rp</span><span class="pull-right"><?php echo number_format($item->jumlah * $item->harga_satuan);?>-</span></td>
        </tr>
        <?php
        } ?>
      </tbody>
    </table>
    <table class="balance">
      <tbody>
        <tr>
          <th><span>Grand Total</span></th>
          <td><b><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($buy->total_harga);?>-</span></b></td>
        </tr>
      </tbody>
    </table>
  </article>

  <aside>
    <h1><span>Pembayaran dapat dilakukan melalui:</span></h1>
    <div class="row">
    <div class="col-xs-5">
      <p>
        <b>Bank BCA</b>: 918-213-999-1 <br>
        A.n. Prime Generation 
      </p>
      <p>
        <b>Bank BRI</b>: 0389-01-0002-20309 <br>
        A.n. Prime Generation
      </p>
    </div>
    <div class="col-xs-offset-1 col-xs-4">
      <p>
        <b>Bank BNI</b>: 14-0897-6000-00 <br>
        A.n. Prime Generation
      </p>
      <p>
        <b>Bank Mandiri</b>: 1020-00-3078-265 <br>
        A.n. Prime Generation
      </p>
    </div>
    </div>
  </aside>

</body>
</html>