<?php
ob_start();
include('src/includes.php');
include('header.php');
ob_end_flush();

echo '
<!DOCTYPE html>
<html>

<head>
    <title>Credits | Quizzane</title>
    <meta name="title" content="Credits | Quizzane">
    <meta name="description" content="All attributed resources used to make this website and any resources used within it are listed here.">
    <meta name="keywords" content="Quizzane, quizzane, Credits, credits">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Antonios P.">
</head>

<body>
    <div align="center">
        <h4 style="padding-top: 3vh;">The font used in the Quizzane<sup>&copy;</sup> Logo is partially provided by a font made from <a
                href="/onlinewebfonts">Online Web Fonts </a>and is licensed by CC BY 3.0
    </div>
    </h3>
    </div>
</body>

</html>
';
include('footer.php');