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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/custom-3.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/edit.css">
	</head>
	<body>
		<div class="header">
			<!-- Navbar  -->
			<?php include('header.php'); ?>
		<!-- /Header -->
		</div>
		<!-- Page Body -->
		<div class="page-body login" style="margin-top: 60px;">
			<div class="container">
				<div class="row row-centered">
					<div class="col-xs-12 col-sm-6 col-md-5 col-centered">
						<?php echo $this->session->flashdata('alert'); ?>
						
						<div class="alert alert-warning text-center" id="alertLoginFb" style="display:none;">
							Akun FB ini belum terdaftar dalam database PrimeMobile. Silahkan <strong>Log In</strong> untuk menghubungkan akun FB ini dengan akun PrimeMobile atau <strong>Sign Up</strong> dengan menggunakan akun FB ini.
						</div>

            <a class="btn btn-primary btn-lg" id="btnShareFb" href="#">Share di Facebook</a>
            <a class="btn btn-info btn-lg" id="btnShareTwt" href="#">Share di Twitter</a>

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
	
    
    <!-- Twitter Init -->
    <script>
    window.twttr = (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
      t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
          t._e.push(f);
        };

        return t;
      }(document, "script", "twitter-wjs"));
    </script>

    <!-- Facebook Init -->
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
         
        } else if (response.status === 'not_authorized') {
          // The person is logged into Facebook, but not your app.
          // document.getElementById('status').innerHTML = 'Please log ' +
          //   'into this app.';
        }
      }  
    </script>
      
    <script type="text/javascript">
      document.getElementById('btnShareFb').onclick = function() {
        shareActivityFb();
      }
      function shareActivityFb() {
        FB.ui({
          method      : 'share',
          display     : 'popup',
          href        : "<?php echo $fb_config['href']?>",
          picture     : "<?php echo $fb_config['picture']?>",
          title       : "<?php echo $fb_config['title']?>",
          description : "<?php echo $fb_config['description']?>",
          caption     : "<?php echo $fb_config['caption']?>",
        }, function(response){});
      }
    </script>

    <script type="text/javascript">
      document.getElementById('btnShareTwt').onclick = function(e) {
        shareActivityTwt();
      }
      function shareActivityTwt()
      {
         var linkURL = "https://twitter.com/intent/tweet?text=";
         var url  = "<?php echo $twt_config['url']?>";
         var text = "<?php echo $twt_config['text']?>";
         if( text.length > 117 ) { text = text.substr(0,112) + "[...]"; }
         linkURL += encodeURIComponent(text) + " " + encodeURIComponent(url);
         $("#btnShareTwt").attr("href", linkURL);
      }
    </script>
	</body>
</html>