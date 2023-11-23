<?php
$con = new mysqli("127.0.0.1", "root", "mariadb", "company");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}