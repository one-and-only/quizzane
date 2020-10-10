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

$(window).on("load", function() {
    playJoin();
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
   <button onclick="playJoin()">play join</button>
</div>

</body>
</html>
';
