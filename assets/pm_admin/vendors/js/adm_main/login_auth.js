$(function(){

$("#username").keyup(function(event){
  if(event.keyCode === 13) {
    $("#submitlogin").click();
  }
})

$("#password").keyup(function(event){
  if(event.keyCode === 13) {
    $("#submitlogin").click();
  }
})

$("#submitlogin").click(function(){
  username  = $("#username").val();
  password  = $("#password").val();
  key       = $("#key").val();
  if(username !== "" && password !== ""){
    $.ajax({
      type: 'POST',
      url: 'adm_main/login_auth',
      data:{
        'username'  : username,
        'password'  : password,
        'key' : key
      }
    });
  }else{
    $("#pesanerror").html("Masukkan Username dan Password!");
    $("#alertlogin").removeClass("hidden");
    $("#alertlogin").addClass("in");
  }
})

$(document).ajaxSend(function(event, jqxhr, settings){
  $("#modal-loader").modal("show");
  if(settings.url === "adm_main/login_auth"){
    $("#text-load").html("Proses Otentikasi User");
  }
});
$(document).ajaxSuccess(function(event, request, options){
  if(options.url === "adm_main/login_auth"){
    $("#modal-loader").modal("hide");
    obj = JSON.parse(request.responseText);
    if(obj['status'] === "failed"){
      $("#key").val(obj['sid']);
      $("#pesanerror").html(obj['keterangan']);
      $("#alertlogin").removeClass("hidden");
      $("#alertlogin").addClass("in");
    }else if(obj['status'] === "success"){
      $("#key").val(obj['sid']);
      window.location.replace("adm_main/redirect_dashboard");
      /*
      $("#pesanerror").html(obj['keterangan']);
      $("#alertlogin").removeClass("hidden");
      $("#alertlogin").addClass("in");
      */

    }
  }
});
$(document).ajaxError(function(event, request, options){
  $("#modal-loader").modal("hide");
  $("#modal-error").modal("show");
});
})