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

$query = "UPDATE STOK SET KODE = :kode, NAMA = :nama, STOK = :stok, SATUAN = :satuan, HARGA = :harga WHERE ID = :id";

// Prepare the OCI statement
$stmt = oci_parse($con, $query);

// Bind the parameters
oci_bind_by_name($stmt, ':kode', $kode);
oci_bind_by_name($stmt, ':nama', $nama);
oci_bind_by_name($stmt, ':stok', $stok);
oci_bind_by_name($stmt, ':satuan', $satuan);
oci_bind_by_name($stmt, ':harga', $harga);
oci_bind_by_name($stmt, ':id', $id);

$result = oci_execute($stmt);

if ($result) {
    setcookie('alert', "success|Berhasil mengedit stok obat", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
} else {
    setcookie('alert', "danger|Gagal mengedit stok obat", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}

oci_free_statement($stmt);
