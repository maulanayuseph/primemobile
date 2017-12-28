$(function(){
	setInterval(UpdateLoginAktif, 60000);
	
	function UpdateLoginAktif(){
		$.ajax({
			type: 'GET',
			url: '/cron/update_timestamp'
		});
	}
})