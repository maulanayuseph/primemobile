<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyCy6BjwXzz92ob2uzaq9PauFN03kKmAbqM",
      authDomain: "prime-mobile-fc14d.firebaseapp.com",
      databaseURL: "https://prime-mobile-fc14d.firebaseio.com",
      projectId: "prime-mobile-fc14d",
      storageBucket: "prime-mobile-fc14d.appspot.com",
      messagingSenderId: "787216888776"
    };
    firebase.initializeApp(config);
  </script>
</head>
<body>
<h1 id="heading"></h1>
<textarea id="mainText"></textarea>
<button id="submitBtn" onclick="submitClick()">Submit</button>

<div style="width: 300px; height: 400px; word-wrap: break-word; overflow-y: scroll;" id="kol-chat">

</div>
<strong>Nama :</strong>
<br><input type="text" id="nama">
<br><strong>Isi Pesan :</strong>
<br>
<textarea id="pesanchat"></textarea>
<button id="kirim-chat">Kirim Chat</button>

<script type="text/javascript">
var mainText = document.getElementById("mainText");
var submitBtn = document.getElementById("submitBtn");

function submitClick(){
  var firebaseRef   = firebase.database().ref();
  pesan             = mainText.value;
  //child mengubah object yang ada atau menambah jika belum ada
  //firebaseRef.child("pesan").set(pesan);
  //push akan membuat object baru dengan random id
  //firebaseRef.push().set(pesan);
  firebaseRef.child("elapsed_time/siswa_1/123/elapsed_time").set(pesan);
}

var firebaseHeadingRef = firebase.database().ref().child('elapsed_time/siswa_1/333/elapsed_time');

firebaseHeadingRef.on('value', function(datasnapshot){
  console.log(datasnapshot);
  if(datasnapshot.val() === null){
    $("#heading").html("null");
  }else{
    $("#heading").html(datasnapshot.val());
  }
})

$("#kirim-chat").click(function(){
  nama = $("#nama").val();
  chat = $("textarea#pesanchat").val();

  firebaseRef  = firebase.database().ref().child("test_chat");
  firebaseRef.push().set({
    nama: nama,
    chat: chat
    });
  $("textarea#pesanchat").val("");
})

var firebasechat = firebase.database().ref().child('test_chat');
firebasechat.on('child_added', function(datasnap){
  nama = datasnap.child("nama").val();
  chat = datasnap.child("chat").val();
  $("#kol-chat").append("<strong>" + nama + " : </strong><br>"+chat+"<br><br>");
})
</script>
</body>
</html>
