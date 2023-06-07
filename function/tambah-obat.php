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

$query = "INSERT INTO stok (kode, nama, stok, satuan, harga) VALUES (:kode, :nama, :stok, :satuan, :harga)";

// Prepare the OCI statement
$stmt = oci_parse($con, $query);

// Bind the parameters
oci_bind_by_name($stmt, ':kode', $kode);
oci_bind_by_name($stmt, ':nama', $nama);
oci_bind_by_name($stmt, ':stok', $stok);
oci_bind_by_name($stmt, ':satuan', $satuan);
oci_bind_by_name($stmt, ':harga', $harga);

// Execute the statement
$result = oci_execute($stmt);

if ($result) {
    setcookie('alert', "success|Berhasil menambahkan stok obat", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
} else {
    setcookie('alert', "danger|Gagal menambahkan stok obat", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}

// Clean up
oci_free_statement($stmt);
