<?php
include "../koneksi.php";


if (count($_POST) == 2) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

    $run = mysqli_query($con, $query);

    if (mysqli_num_rows($run)) {
        $_SESSION['login']['status'] = true;
        $_SESSION['login']['username'] = $username;
        header('Location: ' . BASE_URL . 'dashboard');
    } else {
        setcookie('alert', 'danger|Username atau password tidak ditemukan', time() + 3, '/');
        header('Location: ' . BASE_URL);
        exit;
    }
} else {
    setcookie('alert', 'alert|Username atau password tidak boleh kosong', time() + 3, '/');
    header('Location: ' . BASE_URL);
    exit;
}
