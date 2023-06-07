<?php
include "config.php";


// $con = mysqli_connect("localhost", 'root', '', 'obat');

$username = "DEMO";
$password = "demo";
$database = "localhost/xe";

$con = oci_connect($username, $password, $database);
if (!$con) {
    $m = oci_error();
    trigger_error('Could not connect to database: ' . $m['message'], E_USER_ERROR);
}
