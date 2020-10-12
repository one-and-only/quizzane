<?php
if (!isset($_SESSION['isAuthorized']) or $_SESSION['isAuthorized'] != 'YES') {
    $_SESSION['redirect'] = 'UNAUTHORIZED';
    return 'UNAUTHORIZED';
}
