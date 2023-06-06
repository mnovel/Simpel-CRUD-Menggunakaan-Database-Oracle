<?php
include "../koneksi.php";



if (!empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "DELETE FROM stok WHERE id = $id";

    $run = mysqli_query($con, $query);

    if ($run) {
        setcookie('alert', "success|Berhasil menghapus stok obat", time() + 3, '/');
        header('Location: ' . BASE_URL . 'dashboard');
        exit;
    } else {
        setcookie('alert', "danger|Gagal menghapus stok obat", time() + 3, '/');
        header('Location: ' . BASE_URL . 'dashboard');
        exit;
    }
} else {
    setcookie('alert', "alert|Gagal menghapus stok obat, id tidak boleh kosong", time() + 3, '/');
    header('Location: ' . BASE_URL . 'dashboard');
    exit;
}
