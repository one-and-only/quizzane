<?php
ob_start();
include('src/includes.php');
//include('src/redirectCheck.php');
include('header.php');
ob_end_flush();
echo "Session Redirect: ".$_SESSION['redirectReason'];

switch ($_SESSION['redirectReason']) {
   case 'GAME-NOT-FOUND':
       echo "
       <script>
           swal.fire ({
               icon: 'error',
               title: 'Game Not Found',
               text: 'No game was found with this game code. Ensure that you have entered the game code correctly and the game exists.',
               footer: 'Do you believe this is an error? <a href='mailto:bdpaboi123@gmail.com' class='prettyLink'>Contact Us</a>'
           });
       </script>
       ";
       $_SESSION['redirectReason'] = '';
       break;
   case 'DUPLICATE-GAMECODE':
       echo '//duplicate game code sweetalert';
       $_SESSION['redirectReason'] = '';
       break;
   case 'UNKNOWN-ERROR':
       echo '//unknown error sweetalert';
       $_SESSION['redirectReason'] = '';
       break;
   case 'PASSWORD-MISMATCH':
       echo '//passwords do not match error sweetalert';
       $_SESSION['redirectReason'] = '';
       break;
   case 'REGISTER-SUCCESS':
       echo '//registered successfully success sweetalert';
       $_SESSION['redirectReason'] = '';
       break;
}

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
}
</style>
<link rel="stylesheet" href="src/styles.css">

<audio id="join1">
    <source src="/src/audio/join-page-audio1.mp3" type="audio/mpeg">
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
            if (number <= 1) {
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
          await sleep(1000);
          $("#musicModal").modal("show");
      }
      showMusicModal();
  });

</script>

</head>
<body class="join">

<div>
   <form action="joinbe.php" method="GET" style="padding-left: 40vw; padding-top: 30vh;">
      <div>
         <label for="inputCode"></label>
         <input type="text" class="form-control join codeInput" name="code" id="inputCode" placeholder="123456789" pattern="[0-9]{9}" title="Must be a 9-character number" required />
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
