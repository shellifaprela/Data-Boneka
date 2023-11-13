<?php
include 'koneksi.php';
$boneka = mysqli_query($koneksi, "SELECT * FROM data_boneka");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Boneka</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <h1>Data Boneka</h1>
  <div class="buttons">
    <button id="cancel-button" onclick="location.href='index.html'">Kembali Ke Beranda</button>
  </div>
  <div class="buttons">
    <a href="tambah_boneka.php" class="button tambah">Tambah boneka</a>
  </div>
  <?php if(mysqli_num_rows($boneka) > 0): ?>
    <table>
      <tr>
        <th>Nomor</th>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Foto</th>
        <th>Aksi</th>
      </tr>

      <?php 
      $no = 1;
      while($data = mysqli_fetch_array($boneka)): 
      ?>
        <tr>
          <td><?php echo $data['Nomor']; ?></td>
          <td><?php echo $data['Nama']; ?></td>
          <td><?php echo $data['Jumlah']; ?></td>
          <td><?php echo $data['Harga']; ?></td>
          <td>
            <?php if($data['Foto']): ?>
              <img src="uploads/<?php echo $data['Foto']; ?>" alt="Foto" class="boneka-img">
            <?php else: ?>
              <span>Tidak ada foto</span>
            <?php endif; ?>
          </td>
          <td>
            <a href="ubah_boneka.php?Nomor=<?php echo $data['Nomor']; ?>" class="button ubah">Ubah</a>
            <a href="proses_hapus.php?Nomor=<?php echo $data['Nomor']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="button hapus">Hapus</a>
          </td>
        </tr>
        <?php 
        $no++;
      endwhile; 
      ?>
    </table>

    <?php else: ?>
    <p>Tidak ada data boneka</p>
  <?php endif; ?>
</body>
</html>