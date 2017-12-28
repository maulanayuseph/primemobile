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
   if($status_siswa == "tidak_aktif"){
          redirect('user/dashboard');
         } 
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
        <div class="tableofcontent">
            <div class="table-sidebar">
                <div id="sidebar" class="left-side">
                  <?php include('menu_snmptn.php'); ?>
                </div>
            </div>
      
      <div class="table-desc">
            <div class="desc-content">
              <div class="content-target"></div>
              <h3 align="center">Informasi Umum SNMPTN 2016</h3>
                <p style='text-align:right'>
                  <a class='btn btn-danger' href="<?php echo base_url('assets/pdf/Info_Awal_SNMPTN_2016.pdf');?>" >Unduh Informasi Awal (PDF)</a>
                </p>
              <h3>Latar Belakang</h3>
              <hr>
                  <p>Penerimaan mahasiswa baru harus memenuhi prinsip adil, akuntabel, transparan, dan tidak diskriminatif dengan tidak membedakan jenis kelamin, agama, suku, ras, kedudukan sosial, dan tingkat kemampuan ekonomi calon mahasiswa serta tetap memperhatikan potensi calon mahasiswa dan kekhususan perguruan tinggi. Perguruan tinggi sebagai penyelenggara pendidikan setelah pendidikan menengah menerima calon mahasiswa yang berprestasi akademik tinggi dan diprediksi akan berhasil menyelesaikan studi di perguruan tinggi berdasarkan prestasi akademik. Siswa yang berprestasi tinggi dan konsisten menunjukkan prestasinya layak mendapatkan kesempatan untuk menjadi calon mahasiswa melalui SNMPTN.
                  </p>
                  <p>Dalam kerangka integrasi pendidikan menengah dengan pendidikan tinggi, sekolah diberi peran dalam proses seleksi SNMPTN dengan asumsi bahwa sekolah sebagai satuan pendidikan dan guru sebagai pendidik selalu menjunjung tinggi kehormatan dan kejujuran sebagai bagian dari prinsip pendidikan karakter. Dengan demikian, sekolah berkewajiban mengisi Pangkalan Data Sekolah dan Siswa (PDSS) dengan lengkap dan benar, serta mendorong dan mendukung siswa dalam proses pendaftaran.</p>
              <h3>Tujuan</h3>
              <hr>
                  <p>Tujuan SNMPTN adalah sebagai berikut:</p>
                  <ol>
                  <li><p>memberikan kesempatan kepada siswa Sekolah Menengah Atas (SMA), Madrasah Aliyah (MA), Sekolah Menengah Kejuruan (SMK), atau Sekolah Republik Indonesia (SRI) di luar negeri yang memiliki prestasi unggul untuk memperoleh pendidikan tinggi,</p></li>
                  <li><p>memberikan peluang kepada PTN untuk mendapatkan calon mahasiswa baru yang mempunyai prestasi akademik tinggi.</p></li>
                  </ol>
              <h3>Ketentuan Umum</h3>
              <hr>
                  <ol>
                  <li><p>SNMPTN merupakan pola seleksi nasional berdasarkan hasil penelusuran prestasi akademik dengan menggunakan nilai rapor semester 1 (satu) sampai dengan semester 5 (lima) bagi SMA/MA dan SMK dengan masa belajar 3 (tiga) tahun atau semester 1 (satu) sampai dengan semester 7 (tujuh) bagi SMK dengan masa belajar 4 (empat) tahun, serta Portofolio Akademik.</p></li>
                  <li><p>Pangkalan Data Sekolah dan Siswa (PDSS) merupakan basis data yang berisikan rekam jejak kinerja sekolah dan prestasi akademik siswa.</p></li>
                  <li><p>Sekolah yang siswanya akan mengikuti SNMPTN harus mempunyai Nomor Pokok Sekolah Nasional (NPSN) dan mengisikan data prestasi siswa di PDSS.</p></li>
                  <li><p>Sekolah yang siswanya akan mengikuti SNMPTN harus mempunyai Nomor Pokok Sekolah Nasional (NPSN) dan mengisikan data prestasi siswa di PDSS.</p></li>
                  <li><p>Siswa yang berhak mengikuti seleksi adalah siswa yang memiliki Nomor Induk Siswa nasional (NISN), memiliki prestasi unggul dan rekam jejak prestasi akademik, serta terdaftar di PDSS.</p></li>
                  <li><p>Siswa yang akan mendaftar SNMPTN wajib membaca informasi pada laman PTN yang dipilih tentang ketentuan yang terkait dengan penerimaan mahasiswa baru.</p></li>
                  </ol>

                  <h3>Ketentuan Khusus</h3>
                  <hr>
                  <p>Sekolah yang siswanya berhak mengikuti SNMPTN adalah:</p>
                  <ol>
                  <li><p>SMA/MA, SMK negeri maupun swasta, (termasuk SRI di luar negeri) yang mempunyai NPSN.</p></li>
                  <li><p>Telah mengisi PDSS dengan lengkap dan benar.</p></li>
                  </ol>

                  <h3>Persyaratan Siswa Pendaftar</h3>
                  <hr>
                  <p>Siswa SMA/MA, SMK kelas terakhir pada tahun 2016 yang:</p>
                  <ol>
                  <li><p>memiliki prestasi unggul yaitu: calon peserta masuk peringkat terbaik di sekolah pada semester tiga, semester empat dan semester lima, dengan ketentuan berdasarkan akreditasi sekolah sebagai berikut:
akreditasi A, 75% terbaik di sekolahnya;
akreditasi B, 50% terbaik di sekolahnya;
akreditasi C, 20% terbaik di sekolahnya;
akreditasi lainnya, 10% terbaik di sekolahnya.</p></li>
                  <li><p>memiliki NISN dan terdaftar pada PDSS,</p></li>
                  <li><p>memiliki nilai rapor semester satu sampai semester lima (bagi siswa SMA/MA, SMK tiga tahun) atau nilai rapor semester satu sampai semester tujuh (bagi SMK empat tahun) yang telah diisikan pada PDSS.</p></li>
                  <li><p>memenuhi persyaratan lain yang ditentukan oleh masing-masing PTN (dapat dilihat pada laman PTN bersangkutan).</p></li>
                  </ol>

                  <h3>Penerimaan di PTN</h3>
                  <hr>
                  <p>Peserta diterima di PTN, jika:</p>
                  <ol>
                  <li><p>lulus satuan pendidikan;</p></li>
                  <li><p>lulus SNMPTN 2016; dan</p></li>
                  <li><p>lulus verifikasi data dan memenuhi persyaratan lain yang ditentukan oleh masing-masing PTN penerima.</p></li>
                  </ol>

                  <h3>Tata Cara Mengikuti SNMPTN</h3>
                  <hr>
                  <p>Tata cara mengikuti SNMPTN dilakukan melalui tiga tahap, yaitu (1) pengisian PDSS oleh sekolah dan verifikasi oleh siswa, (2) pemeringkatan, dan (3) pendaftaran SNMPTN oleh siswa.</p>
                  <h3>Pengisian dan Verifikasi PDSS</h3>
                  <ol>
                  <li><p>Kepala Sekolah atau yang ditugaskan oleh Kepala Sekolah mengisi data sekolah dan siswa di PDSS harus melalui laman http://pdss.snmptn.ac.id.</p></li>
                  <li><p>Kepala Sekolah atau yang ditugaskan oleh Kepala Sekolah mendapatkan password yang akan digunakan oleh siswa untuk melakukan verifikasi.</p></li>
                  <li><p>Siswa melakukan verikasi data rekam jejak prestasi akademik (nilai rapor) yang diisikan oleh Kepala Sekolah atau yang ditugaskan oleh Kepala Sekolah dengan menggunakan NISN dan password.</p></li>
                  <li><p>Apabila siswa tidak melaksanakan verifikasi data rekam jejak prestasi akademik (nilai rapor) yang diisikan oleh Kepala Sekolah atau yang ditugaskan oleh Kepala Sekolah maka data yang diisikan dianggap benar dan tidak dapat diubah setelah waktu verifikasi berakhir.</p></li>
                  </ol>

                   <h3>Pengisian dan Verifikasi PDSS</h3>
                    <ol type = "a">
                      <li><p>Kepala Sekolah atau yang ditugaskan oleh Kepala Sekolah mengisi data sekolah dan siswa di PDSS harus melalui laman <a href="http://pdss.snmptn.ac.id/index.html" target="_blank">http://pdss.snmptn.ac.id</a>.</p></li>
                      <li><p>Kepala Sekolah atau yang ditugaskan oleh Kepala Sekolah mendapatkan <em>password</em> yang akan digunakan oleh siswa untuk melakukan verifikasi.</p></li>
                      <li><p>Siswa melakukan verikasi data rekam jejak prestasi akademik (nilai rapor) yang diisikan oleh Kepala Sekolah atau yang ditugaskan oleh Kepala Sekolah dengan menggunakan NISN dan <em>password.</em> </p></li>
                      <li><p>Apabila siswa tidak melaksanakan verifikasi data rekam jejak prestasi akademik (nilai rapor) yang diisikan oleh Kepala Sekolah atau yang ditugaskan oleh Kepala Sekolah maka data yang diisikan dianggap benar dan tidak dapat diubah setelah waktu verifikasi berakhir.</p></li>
                    </ol>
                    <h3>Pemeringkatan</h3>
                    <ol type = "a">
                      <li><p>Panitia Nasional melalui sistem, membuat pemeringkatan siswa berdasarkan nilai mata pelajaran yang menjadi mata uji dalam Ujian Nasional (UN) 2016 pada semester tiga, semester empat dan semester lima.</p></li>
                      <li><p>Bagi siswa yang memenuhi syarat yakni memiliki prestasi akademik unggul berdasarkan pemeringkatan yang dilakukan oleh Panitia Nasional sesuai ketentuan akreditasi sekolah yang diijinkan untuk mendaftar SNMPTN 2016.</p></li>
                    </ol>
                    <h3>Pendaftaran SNMPTN</h3>
                    <ol type="a">
                      <li><p>Pendaftar yang memenuhi kriteria pemeringkatan, menggunakan NISN dan <em>password </em>login ke laman SNMPTN <a href="http://www.snmptn.ac.id" target="_blank">http://www.snmptn.ac.id </a>untuk melakukan pendaftaran.</p></li>
                      <li><p>Pendaftar mengisi biodata, pilihan PTN, dan pilihan program studi, serta mengunggah (<em>upload</em>) pasfoto resmi terbaru dan dokumen prestasi tambahan (jika ada). Siswa Pendaftar harus membaca dan memahami seluruh ketentuan yang berlaku pada PTN yang akan dipilih.</p></li>
                      <li><p>Pendaftar pada program studi seni dan keolahragaan wajib mengunggah portofolio dan dokumen bukti keterampilan yang telah disahkan oleh Kepala Sekolah menggunakan pedoman yang dapat diunduh dari laman
                      <li><p>Pendaftar mencetak Kartu Tanda Peserta  sebagai tanda bukti peserta SNMPTN.</p></li>
                    </ol>
                    <p>Bagi sekolah dan/atau pendaftar yang mengalami kesulitan akses Internet, dapat melakukan pengisian PDSS maupun pendaftaran di PLASA TELKOM di seluruh Indonesia.</p>
                    <h3>Jadwal SNMPTN</h3>
                    <p>Jadwal pelaksanaan SNMPTN adalah sebagai berikut:</p>
                    <table class='table table-bordered' style='width:auto'>
                      <tr>
                        <td class='lbl'>Pengisian dan Verifikasi PDSS</td>
                        <td>18 Januari – 20 Februari 2016</td>
                      </tr>
                      <tr>
                        <td class='lbl'>Pendaftaran SNMPTN</td>
                        <td>29 Februari – 12 Maret 2016</td>
                      </tr>
                      <tr>
                        <td class='lbl'>Pencetakan Kartu Tanda Peserta SNMPTN</td>
                        <td>22 Maret – 21 April 2016</td>
                      </tr>
                      <tr>
                        <td class='lbl'>Proses Seleksi</td>
                        <td>24 Maret – 8 Mei 2016</td>
                      </tr>
                      <tr>
                        <td class='lbl'>Pengumuman Hasil Seleksi</td>
                        <td>9 Mei 2016</td>
                      </tr>
                      <tr>
                        <td class='lbl'>Proses verifikasi dan/atau pendaftaran ulang di PTN masing-masing bagi yang lulus seleksi</td>
                        <td>31 Mei 2016<br /><small>bersamaan dengan pelaksanaan ujian tertulis SBMPTN 2016</small></td>
                      </tr>
                    </table>
                    <p> Pengumuman hasil seleksi dilakukan sesuai jadwal melalui laman resmi SNMPTN di <a href="http://pengumuman.snmptn.ac.id/index.html" target="_blank">http://pengumuman.snmptn.ac.id</a> dan 11 laman <i>mirror</i> berikut:
                    </p>
                    <ul>                 
                        <li><a href="http://snmptn.unand.ac.id/index.html" target="_blank">http://snmptn.unand.ac.id</a></li> 
                        <li><a href="http://snmptn.unsri.ac.id/index.html" target="_blank">http://snmptn.unsri.ac.id</a></li> 
                        <li><a href="http://snmptn.ui.ac.id/index.html" target="_blank">http://snmptn.ui.ac.id</a></li> 
                        <li><a href="http://snmptn.ipb.ac.id/index.html" target="_blank">http://snmptn.ipb.ac.id</a></li> 
                        <li><a href="http://snmptn.itb.ac.id/index.html" target="_blank">http://snmptn.itb.ac.id</a></li> 
                        <li><a href="http://snmptn.undip.ac.id/index.html" target="_blank">http://snmptn.undip.ac.id</a></li> 
                        <li><a href="http://snmptn.ugm.ac.id/index.html" target="_blank">http://snmptn.ugm.ac.id</a></li> 
                        <li><a href="http://snmptn.its.ac.id/index.html" target="_blank">http://snmptn.its.ac.id</a></li> 
                        <li><a href="http://snmptn.unair.ac.id/index.html" target="_blank">http://snmptn.unair.ac.id</a></li> 
                        <li><a href="http://snmptn.untan.ac.id/index.html" target="_blank">http://snmptn.untan.ac.id</a></li> 
                        <li><a href="http://snmptn.unhas.ac.id/index.html" target="_blank">http://snmptn.unhas.ac.id</a></li> 
                    </ul> 
                    <h3>Jumlah Pilihan PTN dan Program Studi</h3>
                    <ol type="a">
                        <li><p>Pendaftar dapat memilih sebanyak-banyaknya 2 (dua) PTN. Apabila memilih 2 (dua) PTN, maka salah satu PTN harus berada di provinsi yang sama dengan SMA asalnya. Apabila memilih satu PTN, maka PTN yang dipilih dapat berada di provinsi mana pun. </p></li>
                        <li><p>Pendaftar dapat memilih sebanyak-banyaknya 3 (tiga) program studi dengan ketentuan dalam satu PTN sebanyak-banyaknya boleh memilih  2 (dua) program studi.</p></li>
                        <li><p>Urutan pilihan PTN dan program studi menyatakan prioritas pilihan.</p></li>
                        <li><p>Siswa SMK hanya diizinkan memilih program studi yang relevan dan ditentukan oleh masing-masing PTN.</p></li>
                        <li><p>Daftar program studi dan daya tampung SNMPTN tahun 2016 dapat dilihat pada laman <a href="http://www.snmptn.ac.id" target="_blank">http://www.snmptn.ac.id</a> selama periode pendaftaran.</p></li>
                    </ol>
                    <h3>Biaya</h3>
                    <p>
                        Biaya SNMPTN ditanggung Pemerintah, sehingga Siswa Pendaftar tidak dipungut biaya apapun (gratis).
                    </p>
                    <h3>Prinsip dan Tahapan Seleksi</h3>
                    <h3>Prinsip Seleksi</h3>
                    <p>
                        Seleksi dilakukan berdasarkan prinsip:
                    </p>
                    <ol type="a">
                          <li><p>mendapatkan calon mahasiswa yang berkualitas secara akademik dengan menggunakan nilai rapor dan prestasi-prestasi akademik lainnya yang relevan dengan program studi yang dipilih;</p></li>
                          <li><p>memperhitungkan rekam jejak kinerja sekolah, antara lain: akreditasi sekolah, prestasi mahasiswa alumni sekolah bersangkutan, jumlah siswa yang diterima melalui jalur SNMPTN, SBMPTN dan Seleksi Mandiri tahun sebelumnya, serta prestasi lainnya yang ditentukan oleh masing-masing PTN;</p></li>
                          <li><p>menggunakan rambu-rambu kriteria seleksi nasional dan kriteria yang ditetapkan oleh masing-masing PTN secara adil, akuntabel, dan transparan.</p></li>
                    </ol>
                      <h3>Tahapan Seleksi</h3>
                      <p>Seleksi dilakukan dengan tahapan sebagai berikut:</p>
                      <ol type ="a">
                        <li><p>Pendaftar diseleksi di PTN pilihan pertama berdasarkan urutan pilihan program studi,</p></li>
                        <li><p>Pendaftar yang memilih dua PTN, apabila dinyatakan tidak lulus pada PTN pilihan pertama, maka akan diseleksi di PTN pilihan kedua berdasarkan urutan pilihan program studi dan ketersediaan daya tampung.</p></li>
                      </ol>
                      <h3>Sanksi Bagi Sekolah dan/atau Siswa yang Melakukan Kecurangan</h3>
                      <p>Penerapan secara tegas bagi siswa/calon mahasiswa dan/atau sekolah yang melakukan kecurangan dengan sanksi sebagai berikut:</p>
                      <ol type="a">
                        <li><p>Sekolah yang melakukan kecurangan tidak diikutsertakan dalam SNMPTN tahun berikutnya.</p></li>
                        <li><p>Siswa yang melakukan kecurangan dibatalkan status kelulusan SNMPTN.</p></li>
                      </ol>
                      <h3>Laman Resmi dan Alamat Panitia Nasional</h3>
                      <ol type="a">
                        <li><p>Informasi resmi mengenai SNMPTN dapat diakses melalui laman <a href="index.html">http://www.snmptn.ac.id</a>.</p></li>
                        <li><p>Informasi resmi lainnya juga dapat diperoleh melalui <a href="http://halo.snmptn.ac.id/index.html" target="_blank">http://halo.snmptn.ac.id</a>, dan <em>call center</em> 08041 450 450.</p></li>
                        <li><p>Informasi juga dapat diperoleh di kantor Humas Perguruan Tinggi Negeri terdekat.</p></li>
                        <li><p>
                          Alamat Panitia Nasional SNMPTN 2016: <br/> 
                        Gedung Rektorat Universitas Negeri Yogyakarta (UNY), Sayap Utara Lantai 1<br/>
                        Jl. Colombo No. 1 Yogyakarta 55281, <br/>
                        Telepon (0274) 544049, <br/>
                        Faksimile (0274) 520 325,<br/>
                        E-mail  : sekretariatseleksi2016@uny.ac.id
                        </p>
                        </li>
                      </ol>
                      <h3>Lain-lain</h3>
                      <ol type="a">
                        <li><p>
                          Siswa Pendaftar dari keluarga kurang mampu dapat mengajukan bantuan biaya pendidikan Bidikmisi melalui laman <a href="http://bidikmisi.belmawa.ristekdikti.go.id/">http://bidikmisi.belmawa.ristekdikti.go.id/</a>.
                          </p>
                        </li>
                        <li>
                        <p>
                          Perubahan ketentuan yang berkaitan dengan pelaksanaan SNMPTN Tahun 2016 akan diinformasikan melalui laman <a href="http://www.snmptn.ac.id">http://www.snmptn.ac.id</a>.
                        </p>
                        </li>
                      </ul>
            </div>
      </div> 
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