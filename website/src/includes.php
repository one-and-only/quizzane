<?php
//stylesheets, scripts, and favicon
echo '
<!DOCTYPE html>
<link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
<link rel="shortcut icon" type="image/png" href="src/logos/quizzane-no-text.png">
<script src="src/bootstrap/js/jquery-3.5.1.slim.min.js"></script>
<script src="src/bootstrap/js/bootstrap.min.js"></script>
<script src="src/bootstrap/js/popper.min.js"></script>
<link rel="stylesheet" href="src/styles.css">
';
//database connection
include('dbconn.php');
//start the session
session_name('user');
session_start();
session_regenerate_id(false);