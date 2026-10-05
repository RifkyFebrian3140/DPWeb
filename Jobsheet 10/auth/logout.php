<<<<<<< HEAD
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];

session_destroy();

header('Location: login.php');
=======
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];

session_destroy();

header('Location: login.php');
>>>>>>> 0762f6413fa933af1a320472983cb60aa6751ab8
exit;