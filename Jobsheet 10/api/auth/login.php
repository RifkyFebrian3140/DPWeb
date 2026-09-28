<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/header.php';
?>

<div class="container">
    <h2>Login Petugas</h2>

    <form action="proses_login.php" method="POST">

        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>

        <br>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <br>

        <button type="submit">Login</button>
    </form>

    <p>
        Belum punya akun?
        <a href="register.php">Daftar di sini</a>
    </p>
</div>

<?php require_once '../includes/footer.php'; ?>