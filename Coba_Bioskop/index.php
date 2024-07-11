<!DOCTYPE html>
<html>
<head>
    <title>Beli Tiket Bioskop</title>
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
        <h1>Pembelian Tiket Bioskop</h1>
      </div>
    </div>
    </header>
    <div class="container">
        <form action="proses_beli_tiket.php" method="post">
            <label for="nama_pembeli">Nama Pembeli:</label>
            <input type="text" id="nama_pembeli" name="nama_pembeli" required><br><br>

            <label for="film_id">Pilih Film:</label>
            <select id="film_id" name="film_id" required>
                <option value="">Pilih Judul Film</option>
                <?php
                include 'koneksi.php';
                $query_film = "SELECT id, judul, harga FROM film";
                $result_film = $conn->query($query_film);
                if ($result_film->num_rows > 0) {
                    while ($row = $result_film->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['judul'] . ' - Harga: Rp ' . number_format($row['harga'], 0, ',', '.') . '</option>';
                    }
                }
                ?>
            </select><br><br>

            <label for="jumlah_tiket">Jumlah Tiket:</label>
            <input type="number" id="jumlah_tiket" name="jumlah_tiket" min="1" required
                   onchange="generateSeatInputs()"><br><br>

            <div id="kursi_container">
                <!-- Kontainer untuk memasukkan pilihan kursi -->
            </div>

            <input type="submit" value="Beli Tiket">
        </form>
    </div>

    <script>
        function generateSeatInputs() {
            var jumlahTiket = document.getElementById('jumlah_tiket').value;
            var kursiContainer = document.getElementById('kursi_container');
            kursiContainer.innerHTML = '';

            for (var i = 0; i < jumlahTiket; i++) {
                var label = document.createElement('label');
                label.textContent = 'Pilih Nomor Kursi untuk Tiket ' + (i + 1) + ': ';
                var select = document.createElement('select');
                select.name = 'nomor_kursi[]'; // Menggunakan [] agar dapat menangani multiple selection
                select.required = true;

                // Generate options for seat numbers based on ticket quantity
                for (var j = 1; j <= 10; j++) { // Misalnya hanya ada 10 kursi
                    var option = document.createElement('option');
                    option.value = j;
                    option.textContent = 'Kursi ' + j;
                    select.appendChild(option);
                }

                kursiContainer.appendChild(label);
                kursiContainer.appendChild(select);
                kursiContainer.appendChild(document.createElement('br'));
            }
        }
    </script>
</body>
</html>
