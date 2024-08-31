<?php
ob_start();
session_start();
$con = mysqli_connect("localhost", "root", "", "iprc") or die("couldn't connect to database");

?>