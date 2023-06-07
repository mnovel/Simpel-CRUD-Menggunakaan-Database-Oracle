<?php
include "../koneksi.php";


if (count($_POST) == 2) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM USERS WHERE USERNAME = :username AND PASSWORD = :password";
    $stmt = oci_parse($con, $query);

    oci_bind_by_name($stmt, ':username', $username);
    oci_bind_by_name($stmt, ':password', $password);

    oci_execute($stmt);

    if (oci_fetch($stmt)) {
        $_SESSION['login']['status'] = true;
        $_SESSION['login']['username'] = $username;
        header('Location: ' . BASE_URL . 'dashboard');
    } else {
        setcookie('alert', 'danger|Username atau password tidak ditemukan', time() + 3, '/');
        header('Location: ' . BASE_URL);
        exit;
    }

    // Clean up
    oci_free_statement($stmt);
    oci_close($conn);
} else {
    setcookie('alert', 'alert|Username atau password tidak boleh kosong', time() + 3, '/');
    header('Location: ' . BASE_URL);
    exit;
}
