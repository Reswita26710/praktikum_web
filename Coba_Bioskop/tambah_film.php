<!DOCTYPE html>
<html>
<head>
    <title>Tambah Film</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Tambah Film Baru</h1>
        </div>
    </header>
    <div class="container">
        <form action="proses_tambah_film.php" method="post">
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" required>

            <label for="durasi">Durasi (menit):</label>
            <input type="number" id="durasi" name="durasi" required>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required>

            <input type="submit" value="Tambah Film">
        </form>
    </div>
</body>
</html>