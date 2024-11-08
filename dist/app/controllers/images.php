<?php
include_once(__DIR__ . '/../database/path.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
include(__DIR__ . '/../database/db.php');

// echo '<pre>';
// print_r($_FILES);
// echo '</pre>';

$stmtMain = $connect->query('SELECT * FROM images');
while ($rowImages2 = $stmtMain->fetchArray(SQLITE3_ASSOC)) {
    if ($rowImages2['name'] === 'katalog_1') $katalog_1 = $rowImages2['url'];
    if ($rowImages2['name'] === 'katalog_2') $katalog_2 = $rowImages2['url'];
    if ($rowImages2['name'] === 'katalog_3') $katalog_3 = $rowImages2['url'];
    if ($rowImages2['name'] === 'katalog_4') $katalog_4 = $rowImages2['url'];
    if ($rowImages2['name'] === 'glvn') $glvn = $rowImages2['url'];
};

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idEdit'])) {
    $idEdit = $_GET['idEdit'];

    $stmt = $connect->prepare('select * from images where id = ?');
    $stmt->bindValue(1, $idEdit, SQLITE3_INTEGER);
    $result = $stmt->execute();
    // $singleTovar = $result->fetchArray(SQLITE3_ASSOC);
};



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['edit'] ?? '';
    $name = $_FILES['img']['name'];

    $stmt = $connect->prepare('update images set url = ? where id = ?');
    $stmt->bindValue(1, $_FILES['img']['name'], SQLITE3_TEXT);
    $stmt->bindValue(2, $id, SQLITE3_INTEGER);
    move_uploaded_file($_FILES['img']['tmp_name'], FOR_FILES . $_FILES['img']['name']);
    $stmt->execute();

    header('Location: ' . BASE_URL . 'admin/images/index.php');
};
