<?php 
require '../koneksi/koneksi.php';
$id = $_GET['id_barang'];


if (hapus($id) > 0){
    echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href = 'index.php';
        </script>
    ";
}
else{
    echo "
        <script>
            alert('data gagal dihapus');
            document.location.href = 'index.php';
        </script>
    ";
}