<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/header.php';
?>

<div class="container">
    <h2>Register Petugas</h2>

    <form action="proses_register.php" method="POST">

        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" required>
        </div>

        <br>

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

        <div>
            <label for="konfirmasi_password">Konfirmasi Password</label>
            <input type="password" id="konfirmasi_password" name="konfirmasi_password" required>
        </div>

        <br>

        <button type="submit">Daftar</button>
    </form>

    <p>
        Sudah punya akun?
        <a href="login.php">Login di sini</a>
    </p>
</div>

<?php require_once '../includes/footer.php'; ?>