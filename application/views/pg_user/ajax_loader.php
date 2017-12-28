<style>
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		width: 100%;
		height: 300px;
		z-index: 9999;
		background: url('<?php echo base_url('assets/img/ajax-loading.gif') ?>') center no-repeat rgba(255, 255, 255, 0.2);
	}
</style>
<script>
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>
<div class="se-pre-con"></div>