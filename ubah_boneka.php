<!DOCTYPE html>
<html>
<head>
    <title>Ubah Boneka</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ubah Boneka</h1>
        <?php
            // Memulai koneksi ke database
            include 'koneksi.php';

            // Mengambil id siswa dari parameter URL
            $Nomor = $_GET['Nomor'];

            // Query untuk mengambil data siswa berdasarkan id
            $query = "SELECT * FROM data_boneka WHERE Nomor='$Nomor'";
            $result = mysqli_query($koneksi, $query);

            // Mengubah data menjadi bentuk array
            $data = mysqli_fetch_array($result);
        ?>
        <form action="proses_ubah.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="Nomor" value="<?php echo $data['Nomor']; ?>">
            <label>Nama:</label>
            <input name="Nama" value="<?php echo $data['Nama']; ?>" required>

            <label>Jumlah:</label>
            <input type="number" name="Jumlah" value="<?php echo $data['Jumlah']; ?>" required>

            <label>Harga</label>
            <input type="number" name="Harga" value="<?php echo $data['Harga']; ?>" required>

            <label>Foto:</label>
            <?php
                if ($data['Foto']) {
                  echo '<img src="uploads/'.$data['Foto'].'" class="boneka-img">';
                } else {
                  echo 'Tidak ada Foto';
                }
            ?>
            <input type="file" name="Foto" accept="image/*">

            <div class="buttons">
                <button type="submit">Ubah Boneka</button>
                <button id="cancel-button" onclick="location.href='index.html'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
