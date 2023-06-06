<?php
include "../koneksi.php";

$alert = "";
foreach ($_POST as $name => $val) {
    if (empty($_POST[$name])) {
        $alert .= "$name, ";
    }
}

if (!empty($alert)) {
    $len = strlen($alert);
    $tr = substr($alert, 0, $len - 2);
    setcookie('alert', "warning|$tr tidak boleh kosong", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$stok = $_POST['stok'];
$satuan = $_POST['satuan'];
$harga = $_POST['harga'];

$query = "INSERT INTO stok (kode, nama, stok, satuan, harga) VALUES ('$kode', '$nama',$stok , '$satuan', '$harga')";

$run = mysqli_query($con, $query);

if ($run) {
    setcookie('alert', "success|Berhasil menambahkan stok obat", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
} else {
    setcookie('alert', "danger|Gagal menambahkan stok obat", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}
