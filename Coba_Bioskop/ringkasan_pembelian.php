<?php
include 'koneksi.php';

// Ambil nama pembeli dari parameter URL
$nama_pembeli = $_GET['nama_pembeli'];

// Query untuk mendapatkan ringkasan pembelian tiket berdasarkan nama pembeli
$query_ringkasan = "SELECT tiket.id, film.judul, tiket.nomor_kursi, tiket.jumlah_tiket, tiket.nama_pembeli, film.harga
                    FROM tiket
                    INNER JOIN film ON tiket.film_id = film.id
                    WHERE tiket.nama_pembeli = '$nama_pembeli'
                    ORDER BY tiket.id DESC";
$result_ringkasan = $conn->query($query_ringkasan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ringkasan Pembelian Tiket</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
    <div class="container">
      <div class="top-half">
        <p>Nama Kelompok : Vitri/Reswita/Yassa/Diva/Bela</p>
        <p>Mata Kuliah : Praktikum Web Programming</p>
      </div>
      <div class="bottom-half">
        <h1>Ringkasan Pembelian Tiket</h1>
      </div>
    </div>
    </header>
    <div class="container">
        <h2>Ringkasan Pembelian untuk <?php echo $nama_pembeli; ?>:</h2>
        <?php
        if ($result_ringkasan->num_rows > 0) {
            $total_harga = 0;
            while ($data = $result_ringkasan->fetch_assoc()) {
                echo '<p><strong>Judul Film:</strong> ' . $data['judul'] . '</p>';
                echo '<p><strong>Nomor Kursi:</strong> ' . $data['nomor_kursi'] . '</p>';
                echo '<p><strong>Jumlah Tiket:</strong> ' . $data['jumlah_tiket'] . '</p>';
                echo '<p><strong>Total Harga:</strong> Rp ' . number_format($data['jumlah_tiket'] * $data['harga'], 0, ',', '.') . '</p>';
                echo '<hr>';
                // Akumulasi total harga
                $total_harga += ($data['jumlah_tiket'] * $data['harga']);
            }
            echo '<h3>Total Pembelian: Rp ' . number_format($total_harga, 0, ',', '.') . '</h3>';
        } else {
            echo "Belum ada pembelian tiket untuk nama pembeli ini.";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
