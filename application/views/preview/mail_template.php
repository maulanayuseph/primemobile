<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  
<!DOCTYPE html>
<html lang="en">
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--[if !mso]><!-->
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/mail_template_styles.css')?>" />
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
      table {border-collapse: collapse;}
    </style>
    <![endif]-->
     
     <title>Prime Mobile - Lupa Password</title>
  </head>
  <body>
      <center class="wrapper">
    <div class="webkit">
      <!--[if (gte mso 9)|(IE)]>
      <table width="600" align="center">
      <tr>
      <td>
      <![endif]-->
      <table class="outer" align="center" style="font-family:arial; line-height:125%;">
        <tr>
          <td class="full-width-image">
            <img src="<?php echo base_url('assets/dashboard/images/logo-footer-merah-putih.png');?>" alt="" />
          </td>
        </tr>
        <tr>
          <td class="one-column">
            <table width="100%">
              <tr>
                <td class="inner contents">
                  <p class="h1"><b>Hai, <?php $nama = explode(" ", $data->nama_siswa); echo reset($nama); ?>!</b></p>
                  <p>
                    Kamu telah mengirim permintaan kepada Prime Mobile untuk mengatur ulang passwordmu. 
                    <br >
                  </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <p>Berikut adalah data akunmu:</p>
          </td>
        </tr>
        <tr>
          <td class="left-sidebar" style="background:#fdeded; border-radius:10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table width="100%">
            <tr>
            <td width="100">
            <![endif]-->
            <div class="column left">
              <table width="100%">
                <tr>
                  <td class="inner">
                    <img src="<?php echo base_url().'assets/uploads/foto_siswa/' . ($data->foto ? $data->foto : 'default.jpg'); ?>" width="80" alt="" style="border-radius:10px;"/>
                  </td>
                </tr>
              </table>
            </div>
            <!--[if (gte mso 9)|(IE)]>
            </td><td width="500">
            <![endif]-->
            <div class="column right">
              <table width="100%">
                <tr>
                  <td class="inner contents">
                    Username: <?php echo $data->username ? $data->username : '-'; ?>
                    <br>Nama Lengkap: <?php echo $data->nama_siswa ? $data->nama_siswa : '-'; ?>
                  </td>
                </tr>
              </table>
            </div>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
          </td>
        </tr>
        <tr>
          <td class="right-sidebar" dir="rtl">
            <!--[if (gte mso 9)|(IE)]>
            <table width="100%" dir="rtl">
            <tr>
            <td width="100">
            <![endif]-->
            
            <!--[if (gte mso 9)|(IE)]>
            </td><td width="500">
            <![endif]-->
            <div class="column right" dir="ltr">
              <table width="100%">
                <tr>
                  <td class="inner contents">
                    <br>
                    Klik link berikut untuk mengatur ulang passwordmu: 
                    <br><strong><a href="<?php echo base_url().'lupa_password?key='.$data->kode_unik; ?>"><?php echo base_url().'lupa_password?key='.$data->kode_unik; ?></a></strong>
                  </td>
                </tr>
              </table>
            </div>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
          </td>
        </tr>
        <tr>
          <td class="one-column">
            <br><hr>
            <table width="100%">
              <tr>
                <td class="inner contents">
                  <p>
                    <i>Jika kamu tidak merasa mengirimkan permintaan ini kepada Prime Mobile, maka abaikan email ini.</i>
                  </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
      </td>
      </tr>
      </table>
      <![endif]-->
    </div>
  </center>
  </body>
</html>