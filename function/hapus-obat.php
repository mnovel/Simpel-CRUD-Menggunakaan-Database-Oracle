<?php
include "../koneksi.php";

if (!empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "DELETE FROM stok WHERE id = :id";

    $stmt = oci_parse($con, $query);

    oci_bind_by_name($stmt, ':id', $id);

    $result = oci_execute($stmt);

    if ($result) {
        setcookie('alert', "success|Berhasil menghapus stok obat", time() + 3, '/');
        header('Location: ' . BASE_URL . 'dashboard');
        exit;
    } else {
        setcookie('alert', "danger|Gagal menghapus stok obat", time() + 3, '/');
        header('Location: ' . BASE_URL . 'dashboard');
        exit;
    }

    oci_free_statement($stmt);
} else {
    setcookie('alert', "alert|Gagal menghapus stok obat, id tidak boleh kosong", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}
