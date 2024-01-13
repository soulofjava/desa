<?php
$servername = "localhost:8889";
$username = "root";
$password = "root";
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

        // Menetapkan nilai default 1 pada kolom desa_id
        $updateQuery = "UPDATE $tableName SET desa_id = 1";
        mysqli_query($conn, $updateQuery);

        echo "Kolom 'desa_id' berhasil ditambahkan dan nilai defaultnya diatur pada tabel '$tableName'.<br>";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
