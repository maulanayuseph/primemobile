$('img').each(function(){
   var alt = $(this).attr('alt');
   var src = $(this).attr('src');
   alamatlatex = src.substring(0, 37);
   alamatlatex2 = src.substring(0, 36);
   var element = this;
   if(alamatlatex === "https://latex.codecogs.com/gif.latex?"){
   	latex = src.substring(37);
   	$.ajax({
		type: 'POST',
		url: '/latex/replace_space',
		data:{
			'latex'	: latex
		},
		success: function(data) {
			//alert(data);
			var newAlt = "$"+ data +"$";
			//alert(newAlt);
   			$(element).replaceWith(newAlt);
		},
	});
}
if(alamatlatex2 === "http://latex.codecogs.com/gif.latex?"){
	latex = src.substring(36);
   	$.ajax({
		type: 'POST',
		url: '/latex/replace_space',
		data:{
			'latex'	: latex
		},
		success: function(data) {
			//alert(data);
			var newAlt = "$"+ data +"$";
			//alert(newAlt);
   			$(element).replaceWith(newAlt);
		},
	});
}
});