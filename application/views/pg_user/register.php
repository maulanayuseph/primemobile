<!DOCTYPE html>
<html lang="en">
    <head>    
        <title>Prime Mobile - Cara belajar masa kini</title>
        
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css')?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css')?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css')?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css')?>">
        
    </head>
    <body>
      <header>
			<!-- nav bar -->
			 <?php include('header_2.php');?>
		</header>
		<section class="page">
			<div class="container">
			    <div class="row row-login">
                    <div class="form-login col-xs-10 col-sm-6 col-md-5">
                        <h2 class="page-title center-title">Daftar</h2>
                        <div class="alert alert-info login-fb" role="alert">
                            <a href="#"><span class="fb-media"></span> Masuk dengan Facebook</a>
                        </div>
                        <div class="log-separator">
                            <div class="left"></div>
                            <div class="middle">atau</div>
                            <div class="right"></div>
                        </div>
                        <form role="form">
                          <h2 class="page-title center-title">Daftar</h2>
                                 <form role="form" name="regform" id="regform" method="" action="">
                                     <div class="form-group">
                                         <input type="text" class="form-control" id="namalengkap" name="namalengkap" placeholder="Nama Lengkap">
                                     </div>
                                     <div class="form-group">
                                         <select name="tingkat" id="tingkat" class="form-control">
                                             <option value="0">Pilih Kota/Kabupaten</option>
                                             <option value="1">Kota Malang</option>
                                             <option value="2">Kabupaten Malang</option>
                                             <option value="3">SMA</option>
                                             <option value="4">SNMPTN</option>
                                             <option value="5">SBMPTN</option>
                                         </select>
                                     </div>
                                     <div class="form-group">
                                         <select name="kelas" id="kelas" class="form-control">
                                             <option value="0">Pilih Kelas</option>
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                             <option value="4">4</option>
                                             <option value="5">5</option>
                                             <option value="6">6</option>
                                             <option value="7">7</option>
                                             <option value="8">8</option>
                                             <option value="9">9</option>
                                             <option value="10">10</option>
                                             <option value="11">11</option>
                                             <option value="12">12</option>
                                         </select>
                                     </div>
                                     <div class="form-group">
                                         <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Nama Sekolah">
                                     </div>
                                     <div class="form-group">
                                         <input type="file" class="form-control" id="foto" name="foto" placeholder="Pilih Foto Profil">
                                     </div>
                                     <div class="form-group">
                                         <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                     </div>
                                     <div class="form-group">
                                         <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                     </div>
                                     <div class="form-group">
                                         <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" placeholder="Konfirmasi Password">
                                     </div>
                          <a href="<?php echo base_url('user')?>" class="btn btn-warning btn-block">DAFTAR</a>
                          <!-- <button type="submit" class="btn btn-warning btn-block">DAFTAR</button> -->
                        </form>
                    </div>
			    </div>
			</div>				
		</section>
		
     <?php include('footer.php');?>
        
        <!-- Javascript -->
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
        <script type="text/javascript" src="js/form-validator/formValidation.js"></script>
        <script type="text/javascript" src="js/form-validator/bootstrap.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#regform').formValidation({
                    message: 'Mohon periksa kembali data anda',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        namalengkap: {
                            validators: {
                                notEmpty: {
                                    message: 'Nama lengkap tidak boleh kosong!'
                                }
                            }
                        },
                        tingkat: {
                            validators: {
                                notEmpty: {
                                    message: 'Pilih salah satu tingkatan!'
                                }
                            }
                        },
                        kelas: {
                            validators: {
                                notEmpty: {
                                    message: 'Pilih salah satu tingkatan!'
                                }
                            }
                        },
                        sekolah: {
                            message: 'Nama pengguna tidak valid',
                            validators: {
                                notEmpty: {
                                    message: 'Nama pengguna tidak boleh kosong'
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
                        nohp: {
                            message: 'Foto profil tidak valid',
                            number: {
                                validators: {
                                    numeric: {
                                        message: 'The value is not a number',
                                        // The default separators
                                        thousandsSeparator: '',
                                        decimalSeparator: '.'
                                    }
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Email Tidak Boleh Kosong'
                                },
                                emailAddress: {
                                    message: 'Email tidak valid'
                                }
                            }
                        },
                        username: {
                            message: 'Nama lengkap tidak valid',
                            validators: {
                                notEmpty: {
                                    message: 'Nama lengkap tidak boleh kosong'
                                },
                                stringLength: {
                                    min: 1,
                                    max: 35,
                                    message: 'Nama lengkap maksimal 35 karakter'
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z/ /]+$/,
                                    message: 'Nama lengkap hanya boleh terdiri dari alfabet dan spasi'
                                }
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'Kata kunci tidak boleh kosong'
                                }
                            }
                        },
                        konfirmasi: {
                            validators: {
                                notEmpty: {
                                    message: 'Kata kunci tidak boleh kosong'
                                },
                                identical: {
                                    field: 'password',
                                    message: 'Kata kunci tidak sama'
                                }
                            }
                        }
                    }
                });
            });
        </script>
    </body>
</html>
    </body>
</html>