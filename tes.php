<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$username = "DEMO";                  // Use your username
$password = "demo";             // and your password
$database = "localhost/xe";   // and the connect string to connect to your database

$c = oci_connect($username, $password, $database);
if (!$c) {
    $m = oci_error();
    trigger_error('Could not connect to database: ' . $m['message'], E_USER_ERROR);
}


$query = oci_parse($c, "SELECT * FROM STOK");
$data = oci_execute($query);
echo "<pre>";
var_dump(oci_fetch_array($query, OCI_BOTH));
