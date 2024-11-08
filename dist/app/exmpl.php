<?php
$connect = mysqli_connect('localhost:3306', 'root', 'root', 'crud');

if (!$connect) {
    die('Mistake');
}

$query = "SELECT * FROM `god`";


$stmt = mysqli_query($connect, "SELECT * FROM `goos`");
