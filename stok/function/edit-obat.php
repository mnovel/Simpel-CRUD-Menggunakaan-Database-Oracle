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
$stok = (int)$_POST['stok'];
$satuan = $_POST['satuan'];
$harga = $_POST['harga'];
$id = $_POST['id'];

$query = "UPDATE stok SET kode = '$kode', nama = '$nama', stok = $stok, satuan = '$satuan', harga  = '$harga' WHERE id = $id";

$run = mysqli_query($con, $query);

if ($run) {
    setcookie('alert', "success|Berhasil mengedit stok obat", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
} else {
    setcookie('alert', "danger|Gagal mengedit stok obat", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}
