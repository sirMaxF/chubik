<?php
include_once(__DIR__ . '/../database/path.php');
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include(__DIR__ . '/../database/db.php');
// $allSizes = [1, 2, 3, 4, 5];
$stmtMain = $connect->query('SELECT * FROM tovary');
// $admin = $stmtMain->fetchArray(SQLITE3_ASSOC);

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// die;

function getData($stmtSelect)
{
    $i = '0';
    while ($row = $stmtSelect->fetchArray(SQLITE3_ASSOC)):
        $array["$i"] = $row;
        $i++;
    endwhile;

    return $array;
}



function bezop($val)
{
    $val = htmlspecialchars($val);
    $val = trim($val);
    $val = stripslashes($val);
    return $val;
}

// получаем все размеры
$stmtRzm = $connect->query('SELECT size from tovary');
$allSizes = [];
foreach (getData($stmtRzm) as $key => $value) {
    foreach (explode(',', $value['size']) as $key => $value) {
        if (!in_array($value, $allSizes)) {
            array_push($allSizes, $value);
        }
    }
}

// получаем все цены
$stmtPrc = $connect->query('select price from tovary');
$prices = [];
foreach (getData($stmtPrc) as $key => $value) {
    array_push($prices, $value['price']);
}

$maxPrice = max($prices);
$minPrice = min($prices);

// echo '<pre>';
// print_r($prices);
// echo '</pre>';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $name = bezop($_POST['name']) ?? '';
    $price = bezop($_POST['price']) ?? '';
    $size = implode(",", $_POST['size']) ?? '';
    $coll = bezop($_POST['coll']) ?? '';
    $type = bezop($_POST['type']) ?? '';
    $artikul = bezop($_POST['artikul']) ?? '';
    $nalichie = 1;


    $stmt = $connect->prepare('insert into tovary (name, price, size, collection, type, artikul, nalichie, img_1, img_2, img_3, img_4, img_5, img_6, img_7) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->bindValue(1, $name, SQLITE3_TEXT);
    $stmt->bindValue(2, $price, SQLITE3_TEXT);
    $stmt->bindValue(3, $size, SQLITE3_TEXT);
    $stmt->bindValue(4, $coll, SQLITE3_TEXT);
    $stmt->bindValue(5, $type, SQLITE3_TEXT);
    $stmt->bindValue(6, $artikul, SQLITE3_INTEGER);
    $stmt->bindValue(7, $nalichie, SQLITE3_INTEGER);
    for ($i = 8; $i < 15; $i++) {
        if (!empty($_FILES['img']['name'][$i - 8])) {
            // print_r($_FILES['img']['name'][$i - 8]);
            $stmt->bindValue($i, $_FILES['img']['name'][$i - 8], SQLITE3_TEXT);
            move_uploaded_file($_FILES['img']['tmp_name'][$i - 8], FOR_FILES . $_FILES['img']['name'][$i - 8]);
        } else {
            $stmt->bindValue($i, '', SQLITE3_TEXT);
        }
    }

    $stmt->execute();

    header('Location: ' . BASE_URL . 'admin/cards/index.php');
};


// страница редактирования, загрузка первонач даннных
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idEdit'])) {
    $idEdit = $_GET['idEdit'];

    $stmt = $connect->prepare('select * from tovary where id = ?');
    $stmt->bindValue(1, $idEdit, SQLITE3_INTEGER);
    $result = $stmt->execute();
    // $singleTovar = $result->fetchArray(SQLITE3_ASSOC);
};

// данные для страницы single
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['singleId'])) {
    $singleId = $_GET['singleId'];

    $stmt = $connect->prepare('select * from tovary where id = ?');
    $stmt->bindValue(1, $singleId, SQLITE3_INTEGER);
    $result = $stmt->execute();

    $forSingle = getData($result);
    // $singleTovar = $result->fetchArray(SQLITE3_ASSOC);
};

// данные для корзины товаров
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cartFetch'])) {


    // echo 'fff';

    // $singleId = $_GET['singleId'];

    // $stmt = $connect->prepare('select * from tovary where id = ?');
    // $stmt->bindValue(1, $singleId, SQLITE3_INTEGER);
    // $result = $stmt->execute();

    // $forSingle = getData($result);
    // $singleTovar = $result->fetchArray(SQLITE3_ASSOC);
};

// редактирование карточки товара
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    // die;
    $id = bezop($_POST['edit']) ?? '';
    $name = bezop($_POST['name']) ?? '';
    $price = bezop($_POST['price']) ?? '';
    $size = implode(",", $_POST['size']) ?? '';
    $coll = bezop($_POST['coll']) ?? '';
    $type = bezop($_POST['type']) ?? '';
    $nalichie = bezop($_POST['nalichie']) ?? 0;
    $artikul = bezop($_POST['artikul']) ?? 0;

    $stmt = $connect->prepare('update tovary set name = ?, price = ?, size = ?, collection = ?, type = ?, nalichie=?, artikul=? where id = ?');
    $stmt->bindValue(1, $name, SQLITE3_TEXT);
    $stmt->bindValue(2, $price, SQLITE3_TEXT);
    $stmt->bindValue(3, $size, SQLITE3_TEXT);
    $stmt->bindValue(4, $coll, SQLITE3_TEXT);
    $stmt->bindValue(5, $type, SQLITE3_TEXT);
    $stmt->bindValue(6, $nalichie, SQLITE3_INTEGER);
    $stmt->bindValue(7, $artikul, SQLITE3_INTEGER);

    $stmt->bindValue(8, $id, SQLITE3_INTEGER);
    $stmt->execute();

    for ($i = 1; $i < 9; $i++) {
        if (!empty($_FILES['img']['name'][$i - 1])) {
            // print_r($_FILES['img']['name'][$i -1]);

            $query = 'update tovary set img_' . $i . ' = ? where id = ?';
            $stmt = $connect->prepare($query);
            $stmt->bindValue(1, $_FILES['img']['name'][$i - 1], SQLITE3_TEXT);
            $stmt->bindValue(2, $id, SQLITE3_INTEGER);
            move_uploaded_file($_FILES['img']['tmp_name'][$i - 1], FOR_FILES . $_FILES['img']['name'][$i - 1]);
            $stmt->execute();
        }
    }

    header('Location: ' . BASE_URL . 'admin/cards/index.php');
};

// удаление
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idDel'])) {
    $idDel = $_GET['idDel'];

    $stmt = $connect->prepare('delete from tovary where id = ?');
    $stmt->bindValue(1, $idDel, SQLITE3_INTEGER);
    $result = $stmt->execute();
    header('Location: ' . BASE_URL . 'admin/cards/index.php');
};

// генерация карточек в каталоге
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fromobsch'])) {
    $stmtMain3 = $connect->query('SELECT * FROM tovary');
    $data = getData($stmtMain3);
    $data = json_encode($data);
    echo   $data;
};


// $connect->close();
