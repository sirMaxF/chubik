<?php
session_start();
include_once(__DIR__ . '/../database/path.php');
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include(__DIR__ . '/../database/db.php');

$stmt = $connect->query('SELECT * FROM users');
$admin = $stmt->fetchArray(SQLITE3_ASSOC);
// print_r($admin);

function bezop($val)
{
    $val = htmlspecialchars($val);
    $val = trim($val);
    $val = stripslashes($val);
    return $val;
}

// админ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin'])) {
    $name = bezop($_POST['text']) ?? '';
    $password = bezop($_POST['password']) ?? '';

    if ($name === $admin['name'] && $password === $admin['password']) {
        $_SESSION['admin'] = 'voshol';
        header('Location: ' . BASE_URL . 'admin/cards/index.php');
    }
}
