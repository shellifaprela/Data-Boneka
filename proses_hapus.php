<?php
// Panggil file koneksi.php
require_once('koneksi.php');

// Validasi parameter id
if (isset($_GET['Nomor']) && is_numeric($_GET['Nomor'])) {
    $id = $_GET['Nomor'];

    // Proses hapus data siswa dari database
    $sql = "DELETE FROM data_boneka WHERE Nomor=$Nomor";
        if (mysqli_query($koneksi, $sql)) {
            header('Location: BERANDA.html');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
            }
} else {
    // Jika parameter id tidak valid, tampilkan pesan error atau redirect ke halaman lain
    echo "Parameter id tidak valid";
    header("Location: halaman_error.php");
}

// Tutup koneksi database
mysqli_close($koneksi);
?>