<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $durasi = $_POST['durasi'];
    $genre = $_POST['genre'];

    $sql = "INSERT INTO film (judul, durasi, genre) VALUES ('$judul', '$durasi', '$genre')";

    if ($conn->query($sql) === TRUE) {
        echo "Film $judul berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    echo "<br><a href='tambah_film.php'>Tambah Film Lain</a>";
}
?>