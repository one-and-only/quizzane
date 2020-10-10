<?php
include('includes.php');

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
