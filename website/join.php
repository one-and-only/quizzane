<?php
ob_start();
include('src/includes.php');
//include('src/redirectCheck.php');
include('header.php');
include('src/redirectCheck.php');
ob_end_flush();
echo "Session Redirect: ".$_SESSION['redirectReason'];

echo '
<head>
<title>Join | Quizzane</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Join a Quizzane game that has been created">
<link rel="shortcut icon" type="image/png" href="src/logos/quizzane-no-text.png">
<style>
.join {
    animation: colorchange 20s linear 1s infinite; /* animation-name followed by duration in seconds*/
       /* you could also use milliseconds (ms) or something like 2.5s */
    -webkit-animation: colorchange 20s linear 0s infinite alternate; /* Chrome and Safari */
  }

  @keyframes colorchange
  {
    0%   {background: red; color: cyan;}
    33%  {background: green; color: magenta;}
    66%  {background: blue; color: yellow;}
    100% {background: red; color: cyan;}
 }

  @-webkit-keyframes colorchange /* Safari and Chrome - necessary duplicate */
  {
    0%   {background: red; color: cyan;}
    33%  {background: green; color: magenta;}
    66%  {background: blue; color: yellow;}
    100% {background: red; color: cyan;}
 }

.codeInput {
   background-color: white !important;
   max-width: 18vw;
   font-size: 35px;
   color: #495057 !important;
   text-align: center;
   border-radius: 10px;
}
</style>
<link rel="stylesheet" href="src/styles.css">

<!-- audio library for join page -->
<audio id="join1">
    <source src="/src/audio/join-page-audio1.mp3" type="audio/mpeg">
</audio>
<audio id="join2">
    <source src="/src/audio/join-page-audio2.mp3" type="audio/mpeg">
</audio>
<audio id="join3">
    <source src="/src/audio/join-page-audio3.mp3" type="audio/mpeg">
</audio>
<audio id="join4">
    <source src="/src/audio/join-page-audio4.mp3" type="audio/mpeg">
</audio>
<audio id="join5">
    <source src="/src/audio/join-page-audio5.mp3" type="audio/mpeg">
</audio>

<script>

number = 1
joinSong = "join" + number

function playJoin() {
    let fn = function(number) {
        let joinSong = "join" + number;
        let audio = document.getElementById(joinSong);
        audio.play();
        audio.onended = function() {
            if (number < 5) {
                fn(number + 1);
            } else {
                fn(1);
            }
        }
    };
    fn(1);
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }
  
  $(window).on("load", function() {
          async function showMusicModal() {
          await sleep(500);
          $("#musicModal").modal("show");
      }
      showMusicModal();
  });

</script>

</head>
<body class="join">

<div>
   <form action="/joinbe" method="GET" style="padding-left: 40vw; padding-top: 30vh;">
      <div>
         <label for="inputCode"></label>
         <input type="text" class="form-control codeInput" name="code" id="inputCode" placeholder="123456789" pattern="[0-9]{9}" title="Must be a 9-character number" required />
         <label for="submitCode"></label>
         <input type="submit" style="font-size: 25px !important; padding: 1vh 4.25vw !important;" class="btn-signature-blue" value="Join Game" id="submitCode" />
      </div>
   </form>
</div>

<!-- enable music modal -->

<div class="modal fade" id="musicModal" tabindex="-1" aria-labelledby="musicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-signature-green">
        <h5 class="modal-title" id="exampleModalLabel">Music</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-signature-blue">
        Would you like to enable music on this page?
      </div>
      <div class="modal-footer modal-signature-blue">
        <button type="button" class="btn-signature-red" data-dismiss="modal">No</button>
        <button type="button" class="btn-signature-green" data-dismiss="modal" onclick="playJoin()">Yes</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
';
