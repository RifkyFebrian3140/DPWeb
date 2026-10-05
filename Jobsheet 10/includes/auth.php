<<<<<<< HEAD
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit;
=======
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit;
>>>>>>> 0762f6413fa933af1a320472983cb60aa6751ab8
}