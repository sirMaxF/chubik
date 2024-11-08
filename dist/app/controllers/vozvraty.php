<?php
include_once(__DIR__ . '/../database/path.php');
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include(__DIR__ . '/../database/db.php');
// $allSizes = [1, 2, 3, 4, 5];
$stmtMain = $connect->query('SELECT * FROM vozvraty');
// $admin = $stmtMain->fetchArray(SQLITE3_ASSOC);

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

function getData($stmtSelect)
{

    $array = [];
    $i = '0';
    while ($row = $stmtSelect->fetchArray(SQLITE3_ASSOC)):
        $array["$i"] = $row;
        $i++;
    endwhile;

    return $array;
}

function getUserE($connect, $email)
{
    $stmtGetOrder = $connect->prepare('select * from users where email = ?');
    $stmtGetOrder->bindValue(1, $email, SQLITE3_TEXT);
    $result = $stmtGetOrder->execute();
    return getData($result)[0];
}

function getUserZ($connect, $id)
{
    $stmtGetOrder = $connect->prepare('select * from users where id = ?');
    $stmtGetOrder->bindValue(1, $id, SQLITE3_INTEGER);
    $result = $stmtGetOrder->execute();
    return getData($result)[0];
}

print_r(getUserE($connect, 'kgn@gmgp.ty9'));


function bezop($val)
{
    $val = htmlspecialchars($val);
    $val = trim($val);
    $val = stripslashes($val);
    return $val;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vernut'])) {
    $name = bezop($_POST['text']) ?? '';
    $tel = bezop($_POST['tel']) ?? '2';
    $email = bezop($_POST['email']) ?? '';

    // print_r(getUserE($connect, $email));

    $user = getUserE($connect, $email);

    if (!isset($user['id'])) {
        echo 'none';
    } else {
        $stmt = $connect->prepare('insert into vozvraty (id_user, name, phone, done) values (?, ?, ?, ?)');
        $stmt->bindValue(1, $user['id'], SQLITE3_INTEGER);
        $stmt->bindValue(2, $name, SQLITE3_TEXT);
        $stmt->bindValue(3, $tel, SQLITE3_TEXT);
        $stmt->bindValue(4, 0, SQLITE3_INTEGER);
        $stmt->execute();

        echo 'uspex';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idDone'])) {
    $id = $_GET['idDone'];
    $done = ($_GET['done'] == 0) ? 1 : 0;


    $stmt = $connect->prepare('update vozvraty set done = ? where id = ?');
    $stmt->bindValue(1, $done, SQLITE3_INTEGER);
    $stmt->bindValue(2, $id, SQLITE3_INTEGER);
    $stmt->execute();
}
