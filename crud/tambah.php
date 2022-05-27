<?php
error_reporting(E_ALL);
include_once '../koneksi/koneksi.php';

if (isset($_POST['submit'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $kategori = htmlspecialchars($_POST['kategori']);
  $harga_jual = htmlspecialchars($_POST['harga_jual']);
  $harga_beli = htmlspecialchars($_POST['harga_beli']);
  $stok = htmlspecialchars($_POST['stok']);
  $file_gambar = $_FILES['file_gambar'];
  $gambar = null;
  if ($file_gambar['error'] == 0) {
    $filename = str_replace(' ', '_', $file_gambar['name']);
    $destination = dirname(__FILE__) . '/gambar/' . $filename;
    if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
      $gambar =  $filename;
    }
  }
  $sql = "INSERT INTO data_barang VALUE ('','$kategori','$nama','$gambar','$harga_beli','$harga_jual','$stok')";
  mysqli_query($conn, $sql);

  if (mysqli_affected_rows($conn) > 0) {
    echo "
      <script>
        alert('Data berhasil ditambahkan');
        document.location.href = 'index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data gagal ditambahkan');
        document.location.href = 'index.php';
      </script>
    ";
  }

  // header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style1.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <h1>Tambah Barang</h1>
    <a href="../index.php" class="data">Data Barang</a>
    <div class="main">
      <form method="post" action="tambah.php" enctype="multipart/form-data">
        <div class="input">
          <label>Nama Barang</label>
          <input type="text" name="nama" required />

          <label>Kategori</label>
          <select name="kategori">
            <option value="Komputer">Komputer</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Hand Phone">Hand Phone</option>
          </select>

          <label>Harga Jual</label>
          <input type="number" name="harga_jual" required />

          <label>Harga Beli</label>
          <input type="number" name="harga_beli" required />

          <label>Stok</label>
          <input type="number" name="stok" required />

          <!-- <label>File Gambar</label>
          <input type="file" name="file_gambar" required /> -->

          <div class="mb-3">
            <label for="formFile" class="form-label">Upload file gambar</label>
            <input class="form-control" name="file_gambar" required type="file" id="formFile">
          </div>
        </div>
        <div class="submit">
          <!-- <input type="submit" name="submit" value="Simpan" /> -->
          <button type="submit" name="submit" class="button">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>