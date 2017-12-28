<!DOCTYPE html>
<html lang="en">
  <head>    
    <title>Prime Generation Integrative Online Learning</title>
    
    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Icon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>" >
    
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-3.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    
  </head>
  <body>
   <?php 
   if($status_siswa == "tidak_aktif"):
          redirect('user/dashboard');
         endif; 
    ?>
    <?php foreach($kelasaktif as $kelass):

              if($kelass->tingkatan_kelas == '10' || $kelass->tingkatan_kelas == '11' || $kelass->tingkatan_kelas == '12'): 
                ?>
    <header class="header">
      <!-- nav bar -->
         <?php include('header.php'); ?>
        <div class="mapel-header" style="margin-top:60px;">
            <h2 class="mapel-title">Halaman SNMPTN</h2>
        </div>
    </header>

    <!-- Table of Content -->
    <div id="content-sidebar" class="tableofcontent-wrapper">
       <div class="container t-title">
    <h2>Daftar Perguruan Tinggi dan Program Studi yang Ditawarkan</h2>
</div>

<div class="container t-content">
  
  
  <div class="col-md-4 ">
    <h3>DAFTAR PERGURUAN TINGGI</h3>
        <p class="info">Klik pada nama perguruan tinggi untuk melihat daftar program studi.</p>
        <table class="table table-condensed fancy">
      <tbody>
                <tr>
                    <td class="no">1</td>
                    <td>
            <a style="font-size:1.1em" href="<?php echo base_url('/snmptn2016/malikusaleh');?>">UNIVERSITAS MALIKUSSALEH</a></strong>
            <div class="info-url"><a href="http://pmb.unimal.ac.id/">http://pmb.unimal.ac.id/</a></div>           <p class="gray">Aceh</p>
                                  </td>
                    <td class="ri"><a href="<?php echo base_url('/snmptn2016/malikusaleh');?>">28</a></td>
                  </tr>
                <tr>
                    <td class="no">2</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/16.html">UNIVERSITAS SAMUDRA</a></strong>
            <div class="info-url"><a href="http://pmb.unsam.ac.id/">http://pmb.unsam.ac.id/</a></div>           <p class="gray">Aceh</p>
                                  </td>
                    <td class="ri"><a href="ptn/16.html">25</a></td>
                  </tr>
                <tr>
                    <td class="no">3</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/11.html">UNIVERSITAS SYIAH KUALA</a></strong>
            <div class="info-url"><a href="http://www.pmb.unsyiah.ac.id/">http://www.pmb.unsyiah.ac.id/</a></div>           <p class="gray">Aceh</p>
                                  </td>
                    <td class="ri"><a href="ptn/11.html">63</a></td>
                  </tr>
                <tr>
                    <td class="no">4</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/13.html">UNIVERSITAS TEUKU UMAR</a></strong>
            <div class="info-url"><a href="http://www.utu.ac.id/">http://www.utu.ac.id/</a></div>           <p class="gray">Aceh</p>
                                  </td>
                    <td class="ri"><a href="ptn/13.html">11</a></td>
                  </tr>
                <tr>
                    <td class="no">5</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/14.html">UNIVERSITAS NEGERI MEDAN</a></strong>
            <div class="info-url"><a href="http://spmb.unimed.ac.id/">http://spmb.unimed.ac.id/</a></div>           <p class="gray">Sumatera Utara</p>
                                  </td>
                    <td class="ri"><a href="ptn/14.html">41</a></td>
                  </tr>
                <tr>
                    <td class="no">6</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/15.html">UNIVERSITAS SUMATERA UTARA</a></strong>
            <div class="info-url"><a href="http://www.usu.ac.id/">http://www.usu.ac.id/</a></div>           <p class="gray">Sumatera Utara</p>
                                  </td>
                    <td class="ri"><a href="ptn/15.html">47</a></td>
                  </tr>
                <tr>
                    <td class="no">7</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/18.html">UNIVERSITAS ANDALAS</a></strong>
            <div class="info-url"><a href="http://pmb.unand.ac.id/">http://pmb.unand.ac.id/</a></div>           <p class="gray">Sumatera Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/18.html">45</a></td>
                  </tr>
                <tr>
                    <td class="no">8</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/17.html">UNIVERSITAS NEGERI PADANG</a></strong>
            <div class="info-url"><a href="http://spmb.unp.ac.id/">http://spmb.unp.ac.id/</a></div>           <p class="gray">Sumatera Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/17.html">48</a></td>
                  </tr>
                <tr>
                    <td class="no">9</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/20.html">UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM</a></strong>
            <div class="info-url"><a href="http://www.uin-suska.ac.id/">http://www.uin-suska.ac.id</a></div>            <p class="gray">Riau</p>
                                  </td>
                    <td class="ri"><a href="ptn/20.html">16</a></td>
                  </tr>
                <tr>
                    <td class="no">10</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/19.html">UNIVERSITAS RIAU</a></strong>
            <div class="info-url"><a href="http://admisi.unri.ac.id/">http://admisi.unri.ac.id/</a></div>           <p class="gray">Riau</p>
                                  </td>
                    <td class="ri"><a href="ptn/19.html">51</a></td>
                  </tr>
                <tr>
                    <td class="no">11</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/22.html">UNIVERSITAS MARITIM RAJA ALI HAJI</a></strong>
            <div class="info-url"><a href="http://pmb.umrah.ac.id/">http://pmb.umrah.ac.id/</a></div>           <p class="gray">Kepulauan Riau</p>
                                  </td>
                    <td class="ri"><a href="ptn/22.html">17</a></td>
                  </tr>
                <tr>
                    <td class="no">12</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/21.html">UNIVERSITAS JAMBI</a></strong>
            <div class="info-url"><a href="http://pmb.unja.ac.id/">http://pmb.unja.ac.id/</a></div>           <p class="gray">Jambi</p>
                                  </td>
                    <td class="ri"><a href="ptn/21.html">56</a></td>
                  </tr>
                <tr>
                    <td class="no">13</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/25.html">UNIVERSITAS BENGKULU</a></strong>
            <div class="info-url"><a href="http://admisi.unib.ac.id/">http://admisi.unib.ac.id/</a></div>           <p class="gray">Bengkulu</p>
                                  </td>
                    <td class="ri"><a href="ptn/25.html">37</a></td>
                  </tr>
                <tr>
                    <td class="no">14</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/28.html">UNIVERSITAS ISLAM NEGERI RADEN FATAH</a></strong>
            <div class="info-url"><a href="http://radenfatah.ac.id/">http://radenfatah.ac.id/</a></div>           <p class="gray">Sumatera Selatan</p>
                                  </td>
                    <td class="ri"><a href="ptn/28.html">9</a></td>
                  </tr>
                <tr>
                    <td class="no">15</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/23.html">UNIVERSITAS SRIWIJAYA</a></strong>
            <div class="info-url"><a href="http://www.reg.unsri.ac.id/">http://www.reg.unsri.ac.id/</a></div>           <p class="gray">Sumatera Selatan</p>
                                  </td>
                    <td class="ri"><a href="ptn/23.html">52</a></td>
                  </tr>
                <tr>
                    <td class="no">16</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/24.html">UNIVERSITAS BANGKA BELITUNG</a></strong>
            <div class="info-url"><a href="http://www.ubb.ac.id/">http://www.ubb.ac.id/</a></div>           <p class="gray">Kepulauan Bangka Belitung</p>
                                  </td>
                    <td class="ri"><a href="ptn/24.html">15</a></td>
                  </tr>
                <tr>
                    <td class="no">17</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/26.html">INSTITUT TEKNOLOGI SUMATERA</a></strong>
            <div class="info-url"><a href="http://usm.itera.ac.id/">http://usm.itera.ac.id</a></div>            <p class="gray">Lampung</p>
                                  </td>
                    <td class="ri"><a href="ptn/26.html">8</a></td>
                  </tr>
                <tr>
                    <td class="no">18</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/27.html">UNIVERSITAS LAMPUNG</a></strong>
            <div class="info-url"><a href="http://simanila.unila.ac.id/">http://simanila.unila.ac.id/</a></div>           <p class="gray">Lampung</p>
                                  </td>
                    <td class="ri"><a href="ptn/27.html">47</a></td>
                  </tr>
                <tr>
                    <td class="no">19</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/31.html">UNIVERSITAS INDONESIA</a></strong>
            <div class="info-url"><a href="https://penerimaan.ui.ac.id/">https://penerimaan.ui.ac.id/</a></div>           <p class="gray">DKI Jakarta</p>
                                  </td>
                    <td class="ri"><a href="ptn/31.html">62</a></td>
                  </tr>
                <tr>
                    <td class="no">20</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/32.html">UNIVERSITAS ISLAM NEGERI JAKARTA</a></strong>
            <div class="info-url"><a href="http://spmb.uinjkt.ac.id/spmb/pmb.zul">http://spmb.uinjkt.ac.id/spmb/pmb.zul</a></div>           <p class="gray">DKI Jakarta</p>
                                  </td>
                    <td class="ri"><a href="ptn/32.html">24</a></td>
                  </tr>
                <tr>
                    <td class="no">21</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/30.html">UNIVERSITAS NEGERI JAKARTA</a></strong>
            <div class="info-url"><a href="http://penmaba.unj.ac.id/">http://penmaba.unj.ac.id/</a></div>           <p class="gray">DKI Jakarta</p>
                                  </td>
                    <td class="ri"><a href="ptn/30.html">52</a></td>
                  </tr>
                <tr>
                    <td class="no">22</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/39.html">UPN &quot;VETERAN&quot; JAKARTA</a></strong>
            <div class="info-url"><a href="https://penmaru.upnvj.ac.id/">https://penmaru.upnvj.ac.id/</a></div>           <p class="gray">DKI Jakarta</p>
                                  </td>
                    <td class="ri"><a href="ptn/39.html">14</a></td>
                  </tr>
                <tr>
                    <td class="no">23</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/33.html">INSTITUT PERTANIAN BOGOR</a></strong>
            <div class="info-url"><a href="http://admisi.ipb.ac.id/">http://admisi.ipb.ac.id/</a></div>           <p class="gray">Jawa Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/33.html">37</a></td>
                  </tr>
                <tr>
                    <td class="no">24</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/35.html">INSTITUT TEKNOLOGI BANDUNG</a></strong>
            <div class="info-url"><a href="http://usm.itb.ac.id/wp">http://usm.itb.ac.id/wp</a></div>           <p class="gray">Jawa Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/35.html">15</a></td>
                  </tr>
                <tr>
                    <td class="no">25</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/37.html">UNIVERSITAS ISLAM NEGERI SUNAN GUNUNG DJATI</a></strong>
            <div class="info-url"><a href="http://www.uinsgd.ac.id/">http://www.uinsgd.ac.id</a></div>            <p class="gray">Jawa Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/37.html">15</a></td>
                  </tr>
                <tr>
                    <td class="no">26</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/36.html">UNIVERSITAS PADJADJARAN</a></strong>
            <div class="info-url"><a href="http://smup.unpad.ac.id/">http://smup.unpad.ac.id/</a></div>           <p class="gray">Jawa Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/36.html">51</a></td>
                  </tr>
                <tr>
                    <td class="no">27</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/34.html">UNIVERSITAS PENDIDIKAN INDONESIA</a></strong>
            <div class="info-url"><a href="http://pmb.upi.edu/">http://pmb.upi.edu</a></div>            <p class="gray">Jawa Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/34.html">75</a></td>
                  </tr>
                <tr>
                    <td class="no">28</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/40.html">UNIVERSITAS SILIWANGI</a></strong>
            <div class="info-url"><a href="http://unsil.ac.id/2016/05/informasi-umum-snmptn-2016/">http://unsil.ac.id/2016/05/informasi-umum-snmptn-2016/</a></div>           <p class="gray">Jawa Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/40.html">20</a></td>
                  </tr>
                <tr>
                    <td class="no">29</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/90.html">UNIVERSITAS SINGAPERBANGSA KARAWANG</a></strong>
            <div class="info-url"><a href="http://snmptn.unsika.ac.id/">http://snmptn.unsika.ac.id</a></div>            <p class="gray">Jawa Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/90.html">15</a></td>
                  </tr>
                <tr>
                    <td class="no">30</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/43.html">UNIVERSITAS DIPONEGORO</a></strong>
            <div class="info-url"><a href="http://www.undip.ac.id/v2/fakultas/">http://www.undip.ac.id/v2/fakultas/</a></div>           <p class="gray">Jawa Tengah</p>
                                  </td>
                    <td class="ri"><a href="ptn/43.html">49</a></td>
                  </tr>
                <tr>
                    <td class="no">31</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/45.html">UNIVERSITAS ISLAM NEGERI WALISONGO</a></strong>
            <div class="info-url"><a href="http://pmb.walisongo.ac.id/">http://pmb.walisongo.ac.id/</a></div>           <p class="gray">Jawa Tengah</p>
                                  </td>
                    <td class="ri"><a href="ptn/45.html">9</a></td>
                  </tr>
                <tr>
                    <td class="no">32</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/41.html">UNIVERSITAS JENDERAL SOEDIRMAN</a></strong>
            <div class="info-url"><a href="http://www.unsoed.ac.id/">http://www.unsoed.ac.id/</a></div>           <p class="gray">Jawa Tengah</p>
                                  </td>
                    <td class="ri"><a href="ptn/41.html">39</a></td>
                  </tr>
                <tr>
                    <td class="no">33</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/42.html">UNIVERSITAS NEGERI SEMARANG</a></strong>
            <div class="info-url"><a href="http://penerimaan.unnes.ac.id/">http://penerimaan.unnes.ac.id/</a></div>           <p class="gray">Jawa Tengah</p>
                                  </td>
                    <td class="ri"><a href="ptn/42.html">65</a></td>
                  </tr>
                <tr>
                    <td class="no">34</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/44.html">UNIVERSITAS SEBELAS MARET</a></strong>
            <div class="info-url"><a href="http://spmb.uns.ac.id/">http://spmb.uns.ac.id/</a></div>           <p class="gray">Jawa Tengah</p>
                                  </td>
                    <td class="ri"><a href="ptn/44.html">65</a></td>
                  </tr>
                <tr>
                    <td class="no">35</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/91.html">UNIVERSITAS TIDAR</a></strong>
            <div class="info-url"><a href="http://untidar.ac.id/">http://untidar.ac.id/</a></div>           <p class="gray">Jawa Tengah</p>
                                  </td>
                    <td class="ri"><a href="ptn/91.html">8</a></td>
                  </tr>
                <tr>
                    <td class="no">36</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/47.html">UNIVERSITAS GADJAH MADA</a></strong>
            <div class="info-url"><a href="http://um.ugm.ac.id/">http://um.ugm.ac.id/</a></div>           <p class="gray">DI Yogyakarta</p>
                                  </td>
                    <td class="ri"><a href="ptn/47.html">66</a></td>
                  </tr>
                <tr>
                    <td class="no">37</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/48.html">UNIVERSITAS ISLAM NEGERI SUNAN KALIJAGA</a></strong>
            <div class="info-url"><a href="http://admisi.uin-suka.ac.id/">http://admisi.uin-suka.ac.id/</a></div>           <p class="gray">DI Yogyakarta</p>
                                  </td>
                    <td class="ri"><a href="ptn/48.html">17</a></td>
                  </tr>
                <tr>
                    <td class="no">38</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/46.html">UNIVERSITAS NEGERI YOGYAKARTA</a></strong>
            <div class="info-url"><a href="http://pmb.uny.ac.id/">http://pmb.uny.ac.id/</a></div>           <p class="gray">DI Yogyakarta</p>
                                  </td>
                    <td class="ri"><a href="ptn/46.html">55</a></td>
                  </tr>
                <tr>
                    <td class="no">39</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/49.html">UPN &quot;VETERAN&quot; YOGYAKARTA</a></strong>
            <div class="info-url"><a href="http://pmb.upnyk.ac.id/">http://pmb.upnyk.ac.id/</a></div>           <p class="gray">DI Yogyakarta</p>
                                  </td>
                    <td class="ri"><a href="ptn/49.html">16</a></td>
                  </tr>
                <tr>
                    <td class="no">40</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/51.html">INSTITUT TEKNOLOGI SEPULUH NOPEMBER</a></strong>
            <div class="info-url"><a href="http://smits.its.ac.id/">http://smits.its.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/51.html">29</a></td>
                  </tr>
                <tr>
                    <td class="no">41</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/52.html">UNIVERSITAS AIRLANGGA</a></strong>
            <div class="info-url"><a href="http://ppmb.unair.ac.id/">http://ppmb.unair.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/52.html">39</a></td>
                  </tr>
                <tr>
                    <td class="no">42</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/56.html">UNIVERSITAS BRAWIJAYA</a></strong>
            <div class="info-url"><a href="http://selma.ub.ac.id/">http://selma.ub.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/56.html">70</a></td>
                  </tr>
                <tr>
                    <td class="no">43</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/57.html">UNIVERSITAS ISLAM NEGERI MALANG</a></strong>
            <div class="info-url"><a href="http://pmb.uin-malang.ac.id/">http://pmb.uin-malang.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/57.html">12</a></td>
                  </tr>
                <tr>
                    <td class="no">44</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/54.html">UNIVERSITAS ISLAM NEGERI SUNAN AMPEL SURABAYA</a></strong>
            <div class="info-url"><a href="http://www.uinsby.ac.id/">http://www.uinsby.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/54.html">17</a></td>
                  </tr>
                <tr>
                    <td class="no">45</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/58.html">UNIVERSITAS JEMBER</a></strong>
            <div class="info-url"><a href="http://www.unej.ac.id/">http://www.unej.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/58.html">41</a></td>
                  </tr>
                <tr>
                    <td class="no">46</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/55.html">UNIVERSITAS NEGERI MALANG</a></strong>
            <div class="info-url"><a href="http://seleksi.um.ac.id/">http://seleksi.um.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/55.html">57</a></td>
                  </tr>
                <tr>
                    <td class="no">47</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/50.html">UNIVERSITAS NEGERI SURABAYA</a></strong>
            <div class="info-url"><a href="http://www.unesa.ac.id/">http://www.unesa.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/50.html">60</a></td>
                  </tr>
                <tr>
                    <td class="no">48</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/53.html">UNIVERSITAS TRUNOJOYO MADURA</a></strong>
            <div class="info-url"><a href="http://pmb.trunojoyo.ac.id/">http://pmb.trunojoyo.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/53.html">22</a></td>
                  </tr>
                <tr>
                    <td class="no">49</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/59.html">UPN &quot;VETERAN&quot; JAWA TIMUR</a></strong>
            <div class="info-url"><a href="http://simaba.upnjatim.ac.id/">http://simaba.upnjatim.ac.id/</a></div>           <p class="gray">Jawa Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/59.html">19</a></td>
                  </tr>
                <tr>
                    <td class="no">50</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/38.html">UNIVERSITAS SULTAN AGENG TIRTAYASA</a></strong>
            <div class="info-url"><a href="http://www.maba.untirta.ac.id/">http://www.maba.untirta.ac.id/</a></div>           <p class="gray">Banten</p>
                                  </td>
                    <td class="ri"><a href="ptn/38.html">35</a></td>
                  </tr>
                <tr>
                    <td class="no">51</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/64.html">UNIVERSITAS PENDIDIKAN GANESHA</a></strong>
            <div class="info-url"><a href="http://undiksha.ac.id/id">http://undiksha.ac.id/id</a></div>           <p class="gray">Bali</p>
                                  </td>
                    <td class="ri"><a href="ptn/64.html">29</a></td>
                  </tr>
                <tr>
                    <td class="no">52</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/63.html">UNIVERSITAS UDAYANA</a></strong>
            <div class="info-url"><a href="https://infoseleksi.unud.ac.id/">https://infoseleksi.unud.ac.id/</a></div>           <p class="gray">Bali</p>
                                  </td>
                    <td class="ri"><a href="ptn/63.html">47</a></td>
                  </tr>
                <tr>
                    <td class="no">53</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/65.html">UNIVERSITAS MATARAM</a></strong>
            <div class="info-url"><a href="http://pmb.unram.ac.id/">http://pmb.unram.ac.id/</a></div>           <p class="gray">Nusa Tenggara Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/65.html">34</a></td>
                  </tr>
                <tr>
                    <td class="no">54</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/66.html">UNIVERSITAS NUSA CENDANA</a></strong>
            <div class="info-url"><a href="http://www.undana.ac.id/">http://www.undana.ac.id/</a></div>           <p class="gray">Nusa Tenggara Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/66.html">47</a></td>
                  </tr>
                <tr>
                    <td class="no">55</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/67.html">UNIVERSITAS TIMOR</a></strong>
            <div class="info-url"><a href="http://www.unimor.ac.id/">http://www.unimor.ac.id/</a></div>           <p class="gray">Nusa Tenggara Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/67.html">11</a></td>
                  </tr>
                <tr>
                    <td class="no">56</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/71.html">UNIVERSITAS TANJUNGPURA</a></strong>
            <div class="info-url"><a href="http://scmb.untan.ac.id/">http://scmb.untan.ac.id/</a></div>           <p class="gray">Kalimantan Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/71.html">64</a></td>
                  </tr>
                <tr>
                    <td class="no">57</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/73.html">UNIVERSITAS PALANGKARAYA</a></strong>
            <div class="info-url"><a href="http://www.upr.ac.id/">http://www.upr.ac.id/</a></div>           <p class="gray">Kalimantan Tengah</p>
                                  </td>
                    <td class="ri"><a href="ptn/73.html">37</a></td>
                  </tr>
                <tr>
                    <td class="no">58</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/75.html">UNIVERSITAS LAMBUNG MANGKURAT</a></strong>
            <div class="info-url"><a href="http://unlam.ac.id/id/2016/03/05/daftar-program-studi-unlam/">http://unlam.ac.id/id/2016/03/05/daftar-program-studi-unlam/</a></div>           <p class="gray">Kalimantan Selatan</p>
                                  </td>
                    <td class="ri"><a href="ptn/75.html">61</a></td>
                  </tr>
                <tr>
                    <td class="no">59</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/79.html">INSTITUT TEKNOLOGI KALIMANTAN</a></strong>
            <div class="info-url"><a href="http://www.itk.ac.id/">http://www.itk.ac.id/</a></div>           <p class="gray">Kalimantan Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/79.html">10</a></td>
                  </tr>
                <tr>
                    <td class="no">60</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/77.html">UNIVERSITAS MULAWARMAN</a></strong>
            <div class="info-url"><a href="http://www.unmul.ac.id/">http://www.unmul.ac.id/</a></div>           <p class="gray">Kalimantan Timur</p>
                                  </td>
                    <td class="ri"><a href="ptn/77.html">53</a></td>
                  </tr>
                <tr>
                    <td class="no">61</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/78.html">UNIVERSITAS BORNEO TARAKAN</a></strong>
            <div class="info-url"><a href="http://pmb.borneo.ac.id/">http://pmb.borneo.ac.id/</a></div>           <p class="gray">Kalimantan Utara</p>
                                  </td>
                    <td class="ri"><a href="ptn/78.html">15</a></td>
                  </tr>
                <tr>
                    <td class="no">62</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/86.html">UNIVERSITAS NEGERI MANADO</a></strong>
            <div class="info-url"><a href="http://www.unima.ac.id/">http://www.unima.ac.id/</a></div>           <p class="gray">Sulawesi Utara</p>
                                  </td>
                    <td class="ri"><a href="ptn/86.html">43</a></td>
                  </tr>
                <tr>
                    <td class="no">63</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/87.html">UNIVERSITAS SAM RATULANGI</a></strong>
            <div class="info-url"><a href="http://www.unsrat.ac.id/">http://www.unsrat.ac.id/</a></div>           <p class="gray">Sulawesi Utara</p>
                                  </td>
                    <td class="ri"><a href="ptn/87.html">43</a></td>
                  </tr>
                <tr>
                    <td class="no">64</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/83.html">UNIVERSITAS TADULAKO</a></strong>
            <div class="info-url"><a href="http://www.untad.ac.id/">http://www.untad.ac.id/</a></div>           <p class="gray">Sulawesi Tengah</p>
                                  </td>
                    <td class="ri"><a href="ptn/83.html">42</a></td>
                  </tr>
                <tr>
                    <td class="no">65</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/82.html">UNIVERSITAS HASANUDDIN</a></strong>
            <div class="info-url"><a href="http://www.unhas.ac.id/pmb">http://www.unhas.ac.id/pmb</a></div>           <p class="gray">Sulawesi Selatan</p>
                                  </td>
                    <td class="ri"><a href="ptn/82.html">60</a></td>
                  </tr>
                <tr>
                    <td class="no">66</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/81.html">UNIVERSITAS ISLAM NEGERI ALAUDDIN</a></strong>
            <div class="info-url"><a href="http://siadin.uin-alauddin.ac.id/">http://siadin.uin-alauddin.ac.id/</a></div>           <p class="gray">Sulawesi Selatan</p>
                                  </td>
                    <td class="ri"><a href="ptn/81.html">4</a></td>
                  </tr>
                <tr>
                    <td class="no">67</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/80.html">UNIVERSITAS NEGERI MAKASSAR</a></strong>
            <div class="info-url"><a href="http://www.unm.ac.id/">http://www.unm.ac.id/</a></div>           <p class="gray">Sulawesi Selatan</p>
                                  </td>
                    <td class="ri"><a href="ptn/80.html">64</a></td>
                  </tr>
                <tr>
                    <td class="no">68</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/84.html">UNIVERSITAS HALUOLEO</a></strong>
            <div class="info-url"><a href="http://www.uho.ac.id/">http://www.uho.ac.id/</a></div>           <p class="gray">Sulawesi Tenggara</p>
                                  </td>
                    <td class="ri"><a href="ptn/84.html">57</a></td>
                  </tr>
                <tr>
                    <td class="no">69</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/89.html">UNIVERSITAS SEMBILAN BELAS NOVEMBER KOLAKA</a></strong>
            <div class="info-url"><a href="http://pmb.usn.ac.id/">http://pmb.usn.ac.id/</a></div>           <p class="gray">Sulawesi Tenggara</p>
                                  </td>
                    <td class="ri"><a href="ptn/89.html">12</a></td>
                  </tr>
                <tr>
                    <td class="no">70</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/85.html">UNIVERSITAS NEGERI GORONTALO</a></strong>
            <div class="info-url"><a href="http://www.ung.ac.id/">http://www.ung.ac.id/</a></div>           <p class="gray">Gorontalo</p>
                                  </td>
                    <td class="ri"><a href="ptn/85.html">50</a></td>
                  </tr>
                <tr>
                    <td class="no">71</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/88.html">UNIVERSITAS SULAWESI BARAT</a></strong>
            <div class="info-url"><a href="https://unsulbar.ac.id/">https://unsulbar.ac.id</a></div>            <p class="gray">Sulawesi Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/88.html">17</a></td>
                  </tr>
                <tr>
                    <td class="no">72</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/93.html">UNIVERSITAS PATTIMURA</a></strong>
            <div class="info-url"><a href="http://www.unpatti.ac.id/">http://www.unpatti.ac.id/</a></div>           <p class="gray">Maluku</p>
                                  </td>
                    <td class="ri"><a href="ptn/93.html">44</a></td>
                  </tr>
                <tr>
                    <td class="no">73</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/95.html">UNIVERSITAS KHAIRUN</a></strong>
            <div class="info-url"><a href="http://www.unkhair.ac.id/">http://www.unkhair.ac.id/</a></div>           <p class="gray">Maluku Utara</p>
                                  </td>
                    <td class="ri"><a href="ptn/95.html">33</a></td>
                  </tr>
                <tr>
                    <td class="no">74</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/94.html">UNIVERSITAS CENDERAWASIH</a></strong>
            <div class="info-url"><a href="http://www.unicen.ac.id/">http://www.unicen.ac.id/</a></div>           <p class="gray">Papua</p>
                                  </td>
                    <td class="ri"><a href="ptn/94.html">38</a></td>
                  </tr>
                <tr>
                    <td class="no">75</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/98.html">UNIVERSITAS MUSAMUS MERAUKE</a></strong>
            <div class="info-url"><a href="http://www.unmus.ac.id/">http://www.unmus.ac.id/</a></div>           <p class="gray">Papua</p>
                                  </td>
                    <td class="ri"><a href="ptn/98.html">25</a></td>
                  </tr>
                <tr>
                    <td class="no">76</td>
                    <td>
            <a style="font-size:1.1em" href="ptn/96.html">UNIVERSITAS PAPUA</a></strong>
            <div class="info-url"><a href="http://unipa.ac.id/index.php/akademik/pendaftaran/snmptn">http://unipa.ac.id/index.php/akademik/pendaftaran/snmptn</a></div>           <p class="gray">Papua Barat</p>
                                  </td>
                    <td class="ri"><a href="ptn/96.html">26</a></td>
                  </tr>
              </tbody>
    </table>
  </div>
      <ul class="quote-wrapper">
        <li></li>
        <li><h5>QUOTES</h5>
            <p>"Bermimpilah tentang apa yang ingin kamu impikan, pergilah ke tempat-tempat kamu 
            ingin pergi, jadilah seperti yang kamu inginkan, karena kamu hanya memiliki satu kehidupan 
            dan satu kesempatan untuk melakukan hal-hal yang ingin kamu lakukan." </p>  
            <h6>“Happy Trenggono”</h6>
        </li>
        <li></li>
      </ul>
      </div>       
    
    <?php include('footer.php');?>
     <? else: redirect('user/dashboard');
      endif; endforeach;?>
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
    
    <!-- Menu Toggle Script -->
    <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
    <script type="text/javascript">
        $('#fixednav').scrollToFixed();
        $('#sidebar').scrollToFixed({
            marginTop: $('.header').outerHeight() - 250,
            limit: function() {
                var limit = $('.footer').offset().top - $('#sidebar').outerHeight(true) - 10;
                return limit;
            },
            zIndex: 999,
            removeOffsets: true
        });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/animatescroll.js');?>"></script>
    
  </body>
</html>