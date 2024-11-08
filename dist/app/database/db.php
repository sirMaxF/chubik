<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
// $db = 'chubik.db';
$db = 'C:\MAMP\htdocs\project\app\database\chubik.db';
// $db = $_SERVER['DOCUMENT_ROOT'] . '/app/database/chubik.db';
$connect = new SQLite3($db);

if (!$connect) {
    die('Соединение не установлено ' . $connect->lastErrorMsg());
};
