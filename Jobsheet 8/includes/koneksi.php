<?php

$host = "db.vgypxaibjupqvutmgymm.supabase.co";
$port = "5432";
$db = "postgres";
$user = "postgres";

// Isi dengan password database Supabase yang sebenarnya
$pass = "PASSWORD_DATABASE_KAMU";

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db;sslmode=require",
        $user,
        $pass
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>