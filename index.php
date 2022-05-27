<?php
include("koneksi/koneksi.php");
// query untuk menampilkan data 
$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style1.css">
  <title>Data Barang</title>
</head>

<body>
  <div class="container">
    <!-- navbar -->
    <?php require('hed/header.php'); ?>
    <!-- akhir navbar -->
    <h1>Data Barang</h1>
    <a href="crud/tambah.php" class="tambah">Tambah Barang</a>
    <div class="main">
      <table>
        <tr>
          <th>NO</th>
          <th>Gambar</th>
          <th>Nama Barang</th>
          <th>Katagori</th>
          <th>Harga Beli</th>
          <th>Harga Jual</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>
        <?php if ($result) : ?>
        <?php $i = 1; ?>
        <?php while ($row = mysqli_fetch_array($result)) :  ?>
        <tr>
          <td><?= $i; ?></td>
          <td><img src="gambar/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>" width="100">
          </td>
          <td><?= $row['nama']; ?></td>
          <td><?= $row['kategori']; ?></td>
          <td><?= $row['harga_beli']; ?></td>
          <td><?= $row['harga_jual']; ?></td>
          <td><?= $row['stok']; ?></td>
          <td>
            <a href="crud/ubah.php?id_barang=<?= $row['id_barang']; ?>" class="button">Ubah</a>
            <a href="crud/hapus.php?id_barang=<?= $row['id_barang']; ?>" class="button1">Hapus</a>
          </td>
        </tr>
        <?php $i++; ?>
        <?php endwhile;
        else : ?>
        <tr>
          <td colspan="7">Belum ada data</td>
        </tr>
        <?php endif; ?>
      </table>
    </div>
    <?php require('hed/footer.php'); ?>
  </div>
</body>

</html>