<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login | Prime Generation Integrative Online Learning</title>
			
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
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/custom.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/custom-2.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/edit.css">
	</head>
	<body>
		<div class="header">
			<!-- Navbar  -->
			<?php include('header_dynamic.php'); ?>
		<!-- /Header -->
		</div>
		<!-- Page Body -->
		<div class="page-body login">
			<div class="container">
				<div class="row row-centered">
					<div class="col-xs-12 col-sm-5 col-md-4 col-centered">
						<?php echo $this->session->flashdata('alert'); ?>
						
						<div class="alert alert-warning text-center" id="alertLoginFb" style="display:none;">
							Akun FB ini belum terdaftar dalam database PrimeMobile. Silahkan <strong>Log In</strong> untuk menghubungkan akun FB ini dengan akun PrimeMobile atau <strong>Sign Up</strong> dengan menggunakan akun FB ini.
						</div>

						<h2 class="page-title">Login</h2>
						<div class="alert alert-info login-fb" id="btnLoginFb">
              <span class="fb-media"></span> 
              <span id="labelLoginFb" style="color:#fff">Masuk dengan Facebook</span>
            </div>

						<div class="log-separator">
							<div class="left"></div>
							<div class="middle">atau</div>
							<div class="right"></div>
						</div>
						<form action="<?php echo base_url() ?>login/do_login" method="post" class="log-form">
							<div class="form-group">
                  <input type="hidden" class="form-control" id="fb_id" name="fb_id" placeholder="FB ID" style="display:none;">
                </div>
							<div class="form-group">
								<input type="text" class="form-control form-custom" placeholder="Username/E-mail" required name="username">
							</div>
							<div class="form-group">
								<input type="password" class="form-control form-custom" placeholder="Password" required name="password">
							</div>
							<div class="form-group">
								<select name="akses" class="form-control">
									<option value="siswa">Siswa</option>
									<option value="parent">Orang Tua</option>
								</select>
							</div>
							<input type="submit" name="login" value="Login" class="btn btn-full-width">
						</form>
						<!-- Ibnu -->
						<div class="login-action">
						   <div class="login-forgot">
							   <a href="#" id="" data-toggle="modal" data-target="#modalLupaPassword">Lupa Password?</a>
						   </div> 
						   <div class="login-new">
							   <a href="<?php echo base_url('signup') ?>">Daftar akun baru</a>
						   </div>
						</div>
						<!-- /Ibnu -->
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
    <?php include('modal_lupa_password.php');?>
		<?php include('footer.php');?>
		<!-- /Footer -->

		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>"></script>
		
		<script type="text/javascript">
      $(document).ready(function() {
        $("#btnLoginFb").on("click", function() {
          _login();
        })
      })
    </script>

    <script type="text/javascript">
    //Validator untuk modal_lupa_password
      $(document).ready(function() {
       $('#formLupaPassword')
       .formValidation({
          icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
            email_reset: {
              validators: {
                notEmpty: {
                    message: 'Alamat email tidak boleh kosong'
                },
                emailAddress: {
                    message: 'Alamat email tidak valid'
                }
              }
            }
          }
        })
       .on('success.form.fv', function(e, data) {
          // Prevent form submission
          e.preventDefault();
          var email = $("input[name^='email_reset']").val();
          var $form = $(e.target),
              fv    = $form.data('formValidation');

          if (fv.getSubmitButton()) {
              $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: {email:email},
                success: function(response){
                  if(response === 'true') {
                    $("#alertDangerLupaPassword").slideUp();
                    $("#alertSuccessLupaPassword").slideDown().delay(4000).slideUp();
                  } 
                  else {
                    $("#alertSuccessLupaPassword").slideUp();
                    $("#alertDangerLupaPassword").slideDown().delay(4000).slideUp();
                  }
                }
              });
            }
        })

       $('#modalLupaPassword').on('hidden.bs.modal', function() {
          $('#formLupaPassword').formValidation('resetForm', true);
        })

      });
    </script>

    <!-- Facebook Login -->
    <script>
      // Load the SDK asynchronously
     
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
        
      window.fbAsyncInit = function() {
      FB.init({
        appId      : '674931862665310', //Your APP ID
        cookie     : true,  // enable cookies to allow the server to access 
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.7' // use version 2.1
      });

      // These three cases are handled in the callback function.
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });

      };
        
      // This is called with the results from from FB.getLoginStatus().
      function statusChangeCallback(response) {
        if (response.status === 'connected') {
          // Logged into your app and Facebook.
          FB.api('/me?fields=name', function(response) {
          	$("#labelLoginFb").text("Masuk sebagai " + response.name);
          });
        } else if (response.status === 'not_authorized') {
          // The person is logged into Facebook, but not your app.
          // document.getElementById('status').innerHTML = 'Please log ' +
          //   'into this app.';
        }
      }  
      
      function _login() {
        FB.login(function(response) {
           // handle the response
           if(response.status==='connected') {
            _i();
           }
         }, {scope: 'email, public_profile'});
      }

      function _logout() {
          FB.logout(function(response) {
            // user is now logged out
          });
      }
     
     function _i(){
         FB.api('/me?fields=name, email', function(response) {
            // console.log(response);
            $("#labelLoginFb").text("Masuk sebagai " + response.name);

            $.ajax({ 
            	url: "<?php echo base_url('login/cek_akun_fb')?>",
            	type: 'post',
            	data: { 'id': response.id },
		          success: function(data, status) {
		          	// console.log("data: " + data);
		          	if(data == 'true') {
		          		// console.log("Hey it's true");
		          		window.location.replace("<?php echo base_url();?>");
		          	} 
		          	else if(data == 'false') {
		          		// console.log("Hey it's false");
		          		$("#alertLoginFb").fadeIn();
		          	}
		          },
		          error: function(xhr, desc, err) {
		            console.log(xhr);
		            console.log("Details: " + desc + "\nError:" + err);
		          }

             })
        });
     }

    </script>
	</body>
</html>