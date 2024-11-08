<?php
include_once(__DIR__ . '/../database/path.php');
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include(__DIR__ . '/../database/db.php');

// обработка платежа

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Success'])) {
    echo 'OK';

    $stmtOplata = $connect->prepare('update zakazy set pay = ? where id = ?');
    $stmtOplata->bindValue(1, $_POST['PaymentId'], SQLITE3_TEXT);
    $stmtOplata->bindValue(2, $_POST['OrderId'], SQLITE3_INTEGER);
    $stmtOplata->execute();
}

// {"TerminalKey":"1623067172665DEMO","OrderId":"1625496924","Success":"true","Status":"CONFIRMED","PaymentId":624757352,"ErrorCode":"0","Amount":50000,"CardId":84187620,"Pan":"430000******0777","ExpDate":"1122"}