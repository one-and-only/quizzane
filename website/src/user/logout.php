<?php
ob_start();
session_name('user');
session_start();
session_destroy();
session_name('user');
session_start();
session_regenerate_id(true);
$_SESSION['isAauthorized'] = 'NO';
$_SESSION['redirectReason'] = 'LOGOUT-SUCCESS';
ob_end_flush();
$URL = "/";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
