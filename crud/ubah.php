<?php
error_reporting(E_ALL);
include_once '../koneksi/koneksi.php';
if (isset($_POST['submit'])) {
  $id_barang = $_POST['id_barang'];
  $nama = $_POST['nama'];
  $kategori = $_POST['kategori'];
  $harga_jual = $_POST['harga_jual'];
  $harga_beli = $_POST['harga_beli'];
  $stok = $_POST['stok'];
  $file_gambar = $_FILES['file_gambar'];
  $gambar = null;
  if ($file_gambar['error'] == 0) {
    $filename = str_replace(' ', '_', $file_gambar['name']);
    $destination = dirname(__FILE__) . '/gambar/' . $filename;
    if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
      $gambar = $filename;;
    }
  }
  $sql = 'UPDATE data_barang SET ';
  $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
  $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";
  if (!empty($gambar))
    $sql .= ", gambar = '{$gambar}' ";
  $sql .= "WHERE id_barang = '{$id_barang}'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_affected_rows($conn) > 0) {
    echo "
      <script>
        alert('Data berhasil diubah');
        document.location.href = '../index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data gagal diubah');
        document.location.href = '../index.php';
      </script>
    ";
  }

  // header('location: index.php');
}

$idd = $_GET['id_barang'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '$idd'";
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);
function is_select($var, $val)
{
  if ($var == $val) return 'selected="selected"';
  return false;
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
    <h1>Update Barang</h1>
    <a href="../index.php" class="data">Data Barang</a>
    <div class="main">
      <form method="post" action="ubah.php" enctype="multipart/form-data">
        <div class="input">

          <label>Nama Barang</label>
          <input type="text" name="nama" required value="<?= $data["nama"]; ?>" />

          <label>Kategori</label>
          <select name="kategori">
            <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Komputer">Komputer</option>
            <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Elektronik">Elektronik
            </option>
            <option <?php echo is_select('Komputer', $data['kategori']); ?> value="HandPhone">Hand Phone
            </option>
          </select>

          <label>Harga Jual</label>
          <input type="number" name="harga_jual" required value="<?= $data["harga_jual"]; ?>" />

          <label>Harga Beli</label>
          <input type="number" name="harga_beli" required value="<?= $data["harga_beli"]; ?>" />

          <label>Stok</label>
          <input type="number" name="stok" required value="<?= $data["stok"]; ?>" />

          <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>" />

          <div class="mb-3">
            <label for="formFile" class="form-label">Upload file gambar</label>
            <input class="form-control" name="file_gambar" type="file" id="formFile" required
              value="<?= $data["gambar"]; ?>">
          </div>
        </div>
        <div class="submit">
          <button type="submit" name="submit" class="button">Update Barang</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>