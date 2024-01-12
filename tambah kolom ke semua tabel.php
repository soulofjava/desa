<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "opensid";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mendapatkan daftar semua tabel dalam database
$result = mysqli_query($conn, "SHOW TABLES");

if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $tableName = $row[0];

        // Menambahkan kolom desa_id dengan tipe UNSIGNED BIGINT ke setiap tabel
        $addColumnQuery = "ALTER TABLE $tableName ADD COLUMN desa_id BIGINT UNSIGNED";
        mysqli_query($conn, $addColumnQuery);
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);