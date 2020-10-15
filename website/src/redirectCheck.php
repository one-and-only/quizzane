<?php
// include js sweetalert file so that it actually works
echo '<script src="/src/sweetalert/sweetalert.all.min.js"></script>';

// check for which type of sweetalert popup
switch ($_SESSION['redirectReason']) {
    case 'GAME-NOT-FOUND':
        echo "
        <script>
        $(window).on('load', function(){
            swal.fire ({
                icon: 'error',
                title: 'Game Not Found',
                text: 'No game was found with this game code. Ensure that you have entered the game code correctly and the game exists.',
                footer: 'Do you believe this is an error?<a style=\'padding-left: 3px; padding-top: 0.75px;\' href=\'mailto:bdpaboi123@gmail.com\' class=\'prettyLinkSweetalert\'> Contact Us</a>'
            });
        });
        </script>
        ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'DUPLICATE-GAMECODE':
        echo "
        <script>
        $(window).on('load', function(){
            swal.fire ({
                icon: 'error',
                title: 'Duplicate Game Code',
                text: 'More than one game with the same game code exists',
                footer: 'This shouldn\'t happen. Please <a style=\'padding-left: 3px; padding-top: 0.75px;\' href=\'mailto:bdpaboi123@gmail.com\' class=\'prettyLinkSweetalert\'> Contact Us</a>'
            });
        });
        </script>
        ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'UNKNOWN-ERROR':
        echo "
        <script>
        $(window).on('load', function(){
            swal.fire ({
                icon: 'error',
                title: 'Unknown Error',
                text: 'An unknown error occured',
                footer: 'This shouldn\'t happen. Please <a style=\'padding-left: 3px; padding-top: 0.75px;\' href=\'mailto:bdpaboi123@gmail.com\' class=\'prettyLinkSweetalert\'> Contact Us</a>'
            });
        });
        </script>
        ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'PASSWORD-MISMATCH':
        echo "
        <script>
        $(window).on('load', function(){
            swal.fire ({
                icon: 'error',
                title: 'Password Mismatch',
                text: 'Please make sure the password and confirm password fields match and try again.',
                footer: 'Still having issues? <a style=\'padding-left: 3px; padding-top: 0.75px;\' href=\'mailto:bdpaboi123@gmail.com\' class=\'prettyLinkSweetalert\'> Contact Us</a>'
            });
        });
        </script>
        ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'REGISTER-SUCCESS':
        echo "
        <script>
        $(window).on('load', function(){
            swal.fire ({
                icon: 'success',
                title: 'Registration Successful',
                text: 'You have successfully registered your new account!',
                footer: 'You are now automatically logged in.'
            });
        });
        </script>
        ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'UPDATE-SUCCESS':
        echo "
            <script>
            $(window).on('load', function(){
                swal.fire ({
                    icon: 'success',
                    title: 'Updated Profile Successfully',
                    text: 'You have successfully updated your profile!',
                    footer: 'You are now automatically logged in.'
                });
            });
            </script>
            ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'LOGIN-SUCCESS':
        echo "
            <script>
            $(window).on('load', function(){
                swal.fire ({
                    icon: 'success',
                    title: 'Login Successful',
                    text: 'You have successfully logged in!'
                });
            });
            </script>
            ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'LOGOUT-SUCCESS':
        echo "
            <script>
            $(window).on('load', function(){
                swal.fire ({
                    icon: 'success',
                    title: 'Logout Successful',
                    text: 'You have successfully logged out'
                });
            });
            </script>
            ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'UNSET-PASSWORD':
        echo "
        <script>
        $(window).on('load', function(){
            swal.fire ({
                icon: 'error',
                title: 'Unset Password Field',
                text: 'Please make sure that the password field is set and try again.',
                footer: 'Still having issues? <a style=\'padding-left: 3px; padding-top: 0.75px;\' href=\'mailto:bdpaboi123@gmail.com\' class=\'prettyLinkSweetalert\'> Contact Us</a>'
            });
        });
        </script>
        ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'UPDATE-SAME-PASSWORD':
        echo "
            <script>
            $(window).on('load', function(){
                swal.fire ({
                    icon: 'error',
                    title: 'Passwords Identical',
                    text: 'Your updated password is the same as the current password.',
                    footer: 'Still having issues? <a style=\'padding-left: 3px; padding-top: 0.75px;\' href=\'mailto:bdpaboi123@gmail.com\' class=\'prettyLinkSweetalert\'> Contact Us</a>'
                });
            });
            </script>
            ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'UNAUTHORIZED':
        echo "
            <script>
            $(window).on('load', function(){
                swal.fire ({
                    icon: 'error',
                    title: 'Unauthorized',
                    text: 'You don't currrently have access to this page.',
                    footer: 'Think this is an error? Please<a style=\'padding-left: 3px; padding-top: 0.75px;\' href=\'mailto:bdpaboi123@gmail.com\' class=\'prettyLinkSweetalert\'> Contact Us</a>'
                });
            });
            </script>
            ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'UNSET-CONFIRM-PASSWORD':
        echo "
        <script>
        $(window).on('load', function(){
            swal.fire ({
                icon: 'error',
                title: 'Unset Confirm Password Field',
                text: 'Please make sure that the confirm password field is set and try again.',
                footer: 'Still having issues? <a style=\'padding-left: 3px; padding-top: 0.75px;\' href=\'mailto:bdpaboi123@gmail.com\' class=\'prettyLinkSweetalert\'> Contact Us</a>'
            });
        });
        </script>
        ";
        $_SESSION['redirectReason'] = '';
        break;
    case 'INVALID-USERPASS':
        echo "
            <script>
            $(window).on('load', function(){
                swal.fire ({
                    icon: 'error',
                    title: 'Invalid Username and Password',
                    text: 'Please make sure the username and password combination is correct and try again.',
                    footer: 'Still having issues? <a style=\'padding-left: 3px; padding-top: 0.75px;\' href=\'mailto:bdpaboi123@gmail.com\' class=\'prettyLinkSweetalert\'> Contact Us</a>'
                });
            });
            </script>
            ";
        $_SESSION['redirectReason'] = '';
        break;
}
