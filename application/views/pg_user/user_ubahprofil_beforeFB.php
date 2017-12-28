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
    <link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/jquery.steps.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/chosen.css');?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>"/>
    
  </head>
  <body>
    <div class="header">
      <!-- Navbar  -->
      <?php include('header_dynamic.php');?>
    </div>
    <section class="page">
      <div class="container">

        <div class="row row-login">
          <div class="form-login col-xs-10 col-sm-6 col-md-5">
            <?php echo $this->session->flashdata('alert'); ?>
            
            <form role="form" name="regform" id="profileForm" method="post" action="<?php echo base_url('user/do_ubah_profil');?>" enctype="multipart/form-data" class="form-horizontal">
              
              <!-- Data Pribadi -->
              <h2>Data Login</h2>
              <section data-step="0">
                <div class="form-group">
                  <label class="pull-left">Nama Lengkap</label>
                  <input type="text" class="form-control" id="namalengkap" name="namalengkap" placeholder="Nama Lengkap" value="<?php echo isset($data_user->nama_siswa) ? $data_user->nama_siswa : ''?>">
                </div>
                <div class="form-group">
                  <label class="pull-left">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo isset($data_user->email) ? $data_user->email : ''?>">
                </div>
                <div class="form-group">
                  <label class="pull-left">Usename</label>
                  <input type="text" class="form-control" id="pengguna" name="pengguna" placeholder="Nama Pengguna" value="<?php echo isset($data_user->username) ? $data_user->username : ''?>">
                </div>
                <div class="form-group">
                  <label class="pull-left">No. Telepon Siswa</label>
                  <input type="text" name="nohp" id="nohp" placeholder="Masukkan nomor handphone" class="form-control" value="<?php echo isset($data_user->telepon) ? $data_user->telepon : ''?>">
                </div>
                <div class="form-group">
                  <label class="pull-left">No. Telepon Orang Tua</label>
                  <input type="text" name="nohp_ortu" id="nohp_ortu" placeholder="Masukkan nomor handphone" class="form-control" value="<?php echo isset($data_user->telepon_ortu) ? $data_user->telepon_ortu : ''?>">
                </div>
                <div class="form-group">
                  <label class="pull-left">Foto</label>
                  <input type="file" class="form-control" id="foto" name="foto" placeholder="Pilih Foto Profil">
                </div>
                <div class="form-group">
                  <label class="pull-left">Password Baru</label>
                  <input type="password" class="form-control" id="katasandi" name="katasandi" placeholder="Kata Sandi">
                </div>
                <div class="form-group">
                  <label class="pull-left">Konfirmasi Password Baru</label>
                  <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" placeholder="Konfirmasi Password">
                </div>
              </section>
                                      
              <!-- Data Sekolah -->
              <h2>Data Sekolah</h2>
              <section data-step="1">
                <div class="form-group pilih-data">
                  <label class="pull-left">Provinsi</label>
                  <select data-placeholder="Pilih Provinsi..." name="provinsi" class="chosen-select form-control" style="width: 100%;" tabindex="1" required="required">
                    <option value="" disabled selected>Pilih Provinsi...</option>
                    <option value="1">Jawa Timur</option>
                    <option value="2">D.I. Yogyakarta</option>
                    <option value="3">Jawa Tengah</option>
                    <option value="4">Jawa Barat</option>
                    <option value="5">D.K.I. Jakarta</option>
                    <option value="6">Banten</option>
                  </select>
                </div>
                <div class="form-group pilih-data">
                  <label class="pull-left">Kota/Kabupaten</label>
                  <select data-placeholder="Pilih Kota/Kabupaten..." name="kota" class="form-control chosen-select" style="width: 100%;" tabindex="1" required="required">
                    <option value="" disabled selected>Pilih Kota/Kabupaten...</option>
                    <option value="1">Kota Malang</option>
                    <option value="2">Kabupaten Malang</option>
                    <option value="3">Kota Pasuruan</option>
                    <option value="4">Kabupaten Pasuruan</option>
                    <option value="5">Kota Sidoarjo</option>
                    <option value="6">Kabupaten Sidoarjo</option>
                    <option value="7">Kota Surabaya</option>
                  </select>
                </div>
                <div class="form-group pilih-data">
                  <label class="pull-left">Sekolah</label>
                  <select data-placeholder="Pilih Sekolah..." name="sekolah" class="form-control chosen-select" onchange="fetch_select_kelas(this.value)" style="width: 100%;" tabindex="1" required="required">
                    <option value="" disabled selected>Pilih Sekolah...</option>
                    <?php 
                    foreach ($select_sekolah as $opt) { ?>
                      <option <?php echo set_select('sekolah', $opt->id_sekolah, (!isset($data_user->sekolah_id) ? FALSE : ($data_user->sekolah_id == $opt->id_sekolah ? TRUE : FALSE)) );?>
                        value="<?php echo $opt->id_sekolah ?>"> <?php echo $opt->nama_sekolah ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group pilih-data">
                  <label class="pull-left">Kelas</label>
                  <select data-placeholder="Pilih Kelas..." name="kelas" id="kelas" class="form-control chosen-select" style="width: 100%;" tabindex="1" required="required">
                    <option value="" disabled selected>Pilih Kelas...</option>
                    <?php 
                    foreach ($select_kelas as $item) { ?>
                      <option <?php echo set_select('kelas', $item->id_kelas, (!isset($data_user->id_kelas) ? FALSE : ($data_user->kelas == $item->id_kelas ? TRUE : FALSE)) );?>
                        value="<?php echo $item->id_kelas ?>" > <?php echo $item->alias_kelas ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </section>
              
            </form>
            
            <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Welcome</h4>
                  </div>
                  <div class="modal-body">
                    <p class="text-center">Thanks for signing up</p>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>        
    </section>
    
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
    
    <!-- Pilih Data -->
<!--        <script type="text/javascript" src="<?php //echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>"></script>-->
    <script type="text/javascript">
//            var config = {
//                '.chosen-select'           : {},
//                '.chosen-select-deselect'  : {allow_single_deselect:true},
//                '.chosen-select-no-single' : {disable_search_threshold:10},
//                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
//                '.chosen-select-width'     : {width:"100%"}
//            }
//            for (var selector in config) {
//                $(selector).chosen(config[selector]);
//            }
    </script>

    <script type="text/javascript">
      function fetch_select_kelas(val)
      {
        console.log("val -> "+val);
        $.ajax({
          type: 'POST',
          url: "<?=base_url('user/ajax_select_kelas')?>",
          data: { id:val },
          success: function(response){
            document.getElementById('kelas').innerHTML=response;
            
            $("#kelas").trigger("chosen:updated");
          }
        });
      }
    </script>
    
    <!-- Validasi -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery.steps.min.js');?>"></script>
    
    <!-- Data Pribadi -->
    <script type="text/javascript">
      $(document).ready(function() {
        function adjustIframeHeight() {
          var $body   = $('body'),
            $iframe = $body.data('iframe.fv');
          if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
          }
        }

        // IMPORTANT: You must call .steps() before calling .formValidation()
        $('#profileForm')
          .steps({
            headerTag: 'h2',
            bodyTag: 'section',
            onStepChanged: function(e, currentIndex, priorIndex) {
              // You don't need to care about it
              // It is for the specific demo
              adjustIframeHeight();
            },
            // Triggered when clicking the Previous/Next buttons
            onStepChanging: function(e, currentIndex, newIndex) {
              var fv         = $('#profileForm').data('formValidation'), // FormValidation instance
                // The current step container
                $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

              // Validate the container
              fv.validateContainer($container);

              var isValidStep = fv.isValidContainer($container);
              if (isValidStep === false || isValidStep === null) {
                // Do not jump to the next step
                return false;
              }

              return true;
            },
            // Triggered when clicking the Finish button
            onFinishing: function(e, currentIndex) {
              var fv         = $('#profileForm').data('formValidation'),
                $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

              // Validate the last step container
              fv.validateContainer($container);

              var isValidStep = fv.isValidContainer($container);
              if (isValidStep === false || isValidStep === null) {
                return false;
              }

              return true;
            },
            onFinished: function(e, currentIndex) {
              // Uncomment the following line to submit the form using the defaultSubmit() method
              $('#profileForm').formValidation('defaultSubmit');

              // For testing purpose
              // $('#welcomeModal').modal();
            }
          })
          .formValidation({
            icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
          
            // This option will not ignore invisible fields which belong to inactive panels
            excluded: ':disabled',
            fields: {
              namalengkap: {
                validators: {
                  notEmpty: {
                    message: 'Nama Lengkap harus diisi'
                  }
                }
              },
              pengguna: {
                validators: {
                  notEmpty: {
                    message: 'Nama pengguna harus diisi'
                  },
                  stringLength: {
                    min: 6,
                    max: 30,
                    message: 'Nama pengguna minimal 6 karakter dan maksimal 30 karakter'
                  },
                  regexp: {
                    regexp: /^[a-zA-Z0-9_\.]+$/,
                    message: 'Nama pengguna hanya terdiri dari alfabet, nomor, titik dan underscore'
                  }
                }
              },
              email: {
                validators: {
                  notEmpty: {
                    message: 'E-Mail harus diisi'
                  },
                  emailAddress: {
                    message: 'E-Mail tidak valid'
                  }
                }
              },
              nohp: {
                message: 'Nomor handphone tidak valid',
                validators: {
                  numeric: {
                    message: 'Nomor handphone harus berbentuk angka'
                  }
                }
              },
              nohp_ortu: {
                message: 'Nomor handphone tidak valid',
                validators: {
                  numeric: {
                    message: 'Nomor handphone harus berbentuk angka'
                  }
                }
              },
              foto: {
                message: 'Foto profil tidak valid',
                validators: {
                  file: {
                    extension: 'jpeg,jpg,gif,png,bmp',
                    type: 'image/jpeg,image/gif,image/png,image/x-ms-bmp',
                    maxSize: 2097152,
                    message: 'File harus bertipe JPEG/JPG/GIF/PNG/BMP dan kurang dari 2 MB'
                  }
                }
              },
              katasandi: {
                validators: {
                  // notEmpty: {
                  //   message: 'Kata sandi harus diisi'
                  // },
                  different: {
                    field: 'username',
                    message: 'Kata sandi tidak boleh sama dengan nama pengguna'
                  }
                }
              },
              konfirmasi: {
                validators: {
                  // notEmpty: {
                  //   message: 'Konfirmasi Kata sandi harus diisi'
                  // },
                  identical: {
                    field: 'katasandi',
                    message: 'Konfirmasi kata sandi harus sama dengan kata sandi yang dimasukkan'
                  }
                }
              }
            }
          });
      });
      </script>
    
  </body>
</html>