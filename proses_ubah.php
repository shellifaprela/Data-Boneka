<?php
// Memulai koneksi ke database
require_once 'koneksi.php';

// Mengambil data dari form
$id = $_POST['Nomor'];
$Nama = $_POST['Nama'];
$kelas = $_POST['Jumlah'];
$no_presensi = $_POST['Harga'];

// Mengecek apakah ada file Foto yang diupload
if (isset($_FILES['Foto']['name']) && $_FILES['Foto']['name'] != '') {
    // Mengambil Nama file dan direktori sementara
    $filename = $_FILES['Foto']['name'];
    $tempname = $_FILES['Foto']['tmp_name'];

    // Menghapus Foto lama
    $query = "SELECT Foto FROM data_boneka WHERE Nomor=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $Foto_lama = $data['Foto'];
    unlink('uploads/'.$Foto_lama);

    // Memindahkan file Foto dari direktori sementara ke direktori yang ditentukan
    move_uploaded_file($tempname, 'uploads/'.$filename);

    // Menyimpan Nama file ke database
    $query = "UPDATE data_boneka SET Nama=?, Jumlah=?, Harga=?, Foto=? WHERE Nomor=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ssssi", $Nama, $Jumlah, $Harga, $filename, $Nomor);
} else {
    // Jika tidak ada file Foto yang diupload, hanya update data siswa tanpa mengubah Foto
    $query = "UPDATE data_boneka SET Nama=?, Jumlah=?, Harga=? WHERE Nomor=?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssi", $Nama, $Jumlah, $Harga, $Nomor);
}

// Menjalankan query untuk mengupdate data siswa
if ($stmt->execute()) {
    header('Location: BERANDA.html');
} else {
    echo "Error: " . $stmt->error;
}

// Menutup koneksi ke database
$stmt->close();
$koneksi->close();
?>