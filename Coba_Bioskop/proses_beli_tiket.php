<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $film_id = $_POST['film_id'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $jumlah_tiket = $_POST['jumlah_tiket'];

    // Mengonversi array nomor_kursi menjadi string yang dipisahkan koma
    $nomor_kursi = implode(', ', $_POST['nomor_kursi']);

    // Query untuk mendapatkan harga film berdasarkan film_id
    $query_harga = "SELECT harga FROM film WHERE id = '$film_id'";
    $result_harga = $conn->query($query_harga);
    if ($result_harga->num_rows > 0) {
        $row = $result_harga->fetch_assoc();
        $harga_total = $row['harga'] * $jumlah_tiket;

        // Query untuk memasukkan data pembelian tiket ke dalam tabel 'tiket'
        $sql = "INSERT INTO tiket (film_id, nomor_kursi, jumlah_tiket, nama_pembeli, harga_total)
                VALUES ('$film_id', '$nomor_kursi', '$jumlah_tiket', '$nama_pembeli', '$harga_total')";

        if ($conn->query($sql) === TRUE) {
            echo "Tiket berhasil dibeli!<br>";

            // Menampilkan opsi "Beli Tiket Lain"
            echo '<a href="beli_tiket.php">Beli Tiket Lain</a><br>';

            // Menampilkan link untuk melihat ringkasan pembelian tiket
            echo '<a href="ringkasan_pembelian.php?nama_pembeli=' . urlencode($nama_pembeli) . '">Lihat Ringkasan Pembelian</a>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Film tidak ditemukan.";
    }
    $conn->close();
}
?>