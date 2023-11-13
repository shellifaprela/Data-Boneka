<?php
// Panggil file koneksi.php
require_once('koneksi.php');

// Validasi parameter id
if (isset($_GET['Nomor']) && is_numeric($_GET['Nomor'])) {
    $id = $_GET['Nomor'];

    // Proses hapus data siswa dari database
    $sql = "DELETE FROM data_boneka WHERE Nomor=?";
    
    // Gunakan prepared statement
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.html');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    // Jika parameter id tidak valid, tampilkan pesan error atau redirect ke halaman lain
    echo "Parameter id tidak valid";
    header("Location: halaman_error.php");
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
