<?php
include_once(__DIR__ . '/../database/path.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
include(__DIR__ . '/../database/db.php');
$allSizes = [1, 2, 3, 4, 5];
$stmtMain = $connect->query('SELECT * FROM zakazy inner join users on zakazy.user_id = users.id inner join dostavki on zakazy.id_dostavka = dostavki.id');


// phpinfo();
// inner join tovary  on zakazy.id_tovar_1 = tovary.id or zakazy.id_tovar_2 = tovary.id or zakazy.id_tovar_3 = tovary.id
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

function getOrder($connect, $id)
{
    $stmtGetOrder = $connect->prepare('select * from tovary where id = ?');
    $stmtGetOrder->bindValue(1, $id, SQLITE3_INTEGER);
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
function getDostavkaZ($connect, $id)
{
    $stmtGetOrder = $connect->prepare('select * from dostavki where id = ?');
    $stmtGetOrder->bindValue(1, $id, SQLITE3_INTEGER);
    $result = $stmtGetOrder->execute();
    return getData($result)[0];
}

// echo '<pre>';
// print_r(getData($stmtMain));
// echo '</pre>';

function bezop($val)
{
    $val = htmlspecialchars($val);
    $val = trim($val);
    $val = stripslashes($val);
    return $val;
}



// запись данных заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pokupka'])) {

    // записываем данные пользователя
    $nameUser = bezop($_POST['name']) ?? '';
    $phone = bezop($_POST['phone']) ?? '';
    $email = bezop($_POST['email']) ?? '';

    $stmSearchUser = $connect->prepare('SELECT * FROM users where email = ?');
    $stmSearchUser->bindValue(1, $email, SQLITE3_TEXT);
    $resultSearchUser = $stmSearchUser->execute();
    $user = getData($resultSearchUser) ?? '';

    $insertedIdUser = '';
    $zakazyUser = [];

    if (!isset($user[0]['id'])) {
        $stmtInsertUser = $connect->prepare('INSERT into users (name, phone, email) values (?, ?, ?)');
        $stmtInsertUser->bindValue(1, $nameUser, SQLITE3_TEXT);
        $stmtInsertUser->bindValue(2, $phone, SQLITE3_INTEGER);
        $stmtInsertUser->bindValue(3, $email, SQLITE3_TEXT);
        $stmtInsertUser->execute();
        $insertedIdUser = $connect->lastInsertRowID();


        // echo $insertedId;

        // $userID = $user[0]['id'];
        // $newZakaz = explode(',', $user[0]['id']).push(.......);
        // $stmSearchUser = $connect->prepare('update users set zakazy = ? where id = ?');
        // $stmSearchUser->bindValue(1, $email, SQLITE3_TEXT);
        // $stmSearchUser->bindValue(1, $email, SQLITE3_TEXT);
        // $resultSearchUser = $stmSearchUser->execute();
    } else {
        $insertedIdUser = $user[0]['id'];
        $zakazyUser = explode(',', $user[0]['zakazy']);
    }


    // заприсываем даные доставки

    $city = bezop($_POST['city']) ?? '';
    $adress = bezop($_POST["address"]) ?? '';
    $fio = bezop($_POST['fio']) ?? '';
    $comm = bezop($_POST['comm']) ?? '';
    $dostavka = bezop($_POST['dostavka']) ?? '';


    $stmtInsertDostavka = $connect->prepare('insert into dostavki (gorod, adress, type, fio) values (?, ?, ?, ?)');
    $stmtInsertDostavka->bindValue(1, $city, SQLITE3_TEXT);
    $stmtInsertDostavka->bindValue(2, $adress, SQLITE3_TEXT);
    $stmtInsertDostavka->bindValue(3, $dostavka, SQLITE3_TEXT);
    $stmtInsertDostavka->bindValue(4, $fio, SQLITE3_TEXT);
    $stmtInsertDostavka->execute();

    $insertedIdDostavka = $connect->lastInsertRowID();

    // echo $insertedIdDostavka;
    // echo $insertedIdUser;


    //записываем данные заказа

    $pokupka = json_decode($_POST["pokupka"], true);


    $stmtInsertZakaz = $connect->prepare('insert into zakazy (user_id, id_dostavka, comment, id_tovar_1, size_1, kolvo_1, id_tovar_2, size_2, kolvo_2, id_tovar_3, size_3, kolvo_3, sum) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

    $comm = bezop($_POST['comm']) ?? '';

    $stmtInsertZakaz->bindValue(1, $insertedIdUser, SQLITE3_INTEGER);
    $stmtInsertZakaz->bindValue(2, $insertedIdDostavka, SQLITE3_INTEGER);
    $stmtInsertZakaz->bindValue(3, $comm, SQLITE3_TEXT);

    $sum = $_POST['sum'];

    // foreach ($pokupka as $key => $value) {
    //     $sum = $sum + getOrder($connect, $value['id']) * $value['kolvo'];
    // }

    $stmtInsertZakaz->bindValue(4, isset($pokupka[0]['id']) ? $pokupka[0]['id'] : null, SQLITE3_INTEGER);
    $stmtInsertZakaz->bindValue(5, isset($pokupka[0]['size']) ? $pokupka[0]['size'] :  null, SQLITE3_INTEGER);
    $stmtInsertZakaz->bindValue(6, isset($pokupka[0]['kolvo']) ?  $pokupka[0]['kolvo'] : null, SQLITE3_INTEGER);

    $stmtInsertZakaz->bindValue(7, isset($pokupka[1]['id']) ? $pokupka[1]['id'] : null, SQLITE3_INTEGER);
    $stmtInsertZakaz->bindValue(8, isset($pokupka[1]['size']) ? $pokupka[1]['size'] :  null, SQLITE3_INTEGER);
    $stmtInsertZakaz->bindValue(9, isset($pokupka[1]['kolvo']) ?  $pokupka[1]['kolvo'] : null, SQLITE3_INTEGER);

    $stmtInsertZakaz->bindValue(10, isset($pokupka[2]['id']) ? $pokupka[2]['id'] : null, SQLITE3_INTEGER);
    $stmtInsertZakaz->bindValue(11, isset($pokupka[2]['size']) ? $pokupka[2]['size'] :  null, SQLITE3_INTEGER);
    $stmtInsertZakaz->bindValue(12, isset($pokupka[2]['kolvo']) ?  $pokupka[2]['kolvo'] : null, SQLITE3_INTEGER);

    $stmtInsertZakaz->bindValue(13, $_POST['sum'], SQLITE3_INTEGER);



    // for ($i = 4, $k = 0; $i <= 5, $k < 4; $i++, $k++) {
    //     echo $i . '//';
    //     $stmtInsertZakaz->bindValue($i, isset($pokupka[$k]['id']) ? $pokupka[$k]['id'] : null, SQLITE3_INTEGER);
    //     $stmtInsertZakaz->bindValue($i + 1, isset($pokupka[$k]['size']) ? $pokupka[$k]['id'] : null, SQLITE3_INTEGER);
    //     $stmtInsertZakaz->bindValue($i + 2, isset($pokupka[$k]['kolvo']) ? $pokupka[$k]['id'] : null, SQLITE3_INTEGER);
    // }

    $stmtInsertZakaz->execute();
    $insertedIdZakaz = $connect->lastInsertRowID();

    // echo $insertedIdZakaz;

    $connect->close();
    $connect2 = new SQLite3($db);



    // записываем id заказа в таблицы пользователей и доставок

    $stmtZakazUser = $connect2->prepare('update users set zakazy = ? where id = ?');
    array_push($zakazyUser, $insertedIdZakaz);

    $zakazyUser = implode(',', $zakazyUser);
    $stmtZakazUser->bindValue(1, $zakazyUser, SQLITE3_TEXT);
    $stmtZakazUser->bindValue(2, $insertedIdUser, SQLITE3_INTEGER);
    $stmtZakazUser->execute();

    $stmtZakazdostavki = $connect2->prepare('update dostavki set id_zakaz = ? where id = ?');
    $stmtZakazdostavki->bindValue(1, $insertedIdZakaz, SQLITE3_INTEGER);
    $stmtZakazdostavki->bindValue(2, $insertedIdDostavka, SQLITE3_INTEGER);
    $stmtZakazdostavki->execute();

    // $connect2->close();

    //! делаем оплату

    // создаем массив с данными
    $data = [
        'Amount' => $sum * 100,
        'Description' => 'Покупка на сайте Чубик',
        'OrderId' => $insertedIdZakaz,
        'TerminalKey' => 1666291526582,
        'NotificationURL' => 'http://o9290256.beget.tech/app/controllers/tinkoff.php',
        'SuccessURL' => 'http://o9290256.beget.tech/',
        // 'TerminalKey' => '200000000947373',
        // 'TerminalKey' => '24940571',
        'Password' => 'dg62xis3uaurlk9s',
    ];

    ksort($data);

    $values = array_values($data);

    // print_r($values);

    $concatString = implode('', $values);
    $hashString = hash('sha256', $concatString);

    $data['Token'] = $hashString;
    $data['DATA'] = json_decode(json_encode(['order_number' => $insertedIdZakaz])); // делаем JSON, а из него объект
    // print_r($data['DATA']);



    // echo $data['DATA'];
    unset($data['Password']);

    $postCurl = json_encode($data);

    // настраиваем curl 

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://securepay.tinkoff.ru/v2/Init');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postCurl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postCurl)
    ]);

    $output = curl_exec($ch);
    $httpHDRS = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($output === false || $httpHDRS !== 200) {
        error_log('не удалось выполнить запрос, http код ' . $httpHDRS);
        return false;
    }

    $outputArray = json_decode($output, true);
    // print_r($outputArray);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Ошибка при декодировании массива' . json_last_error_msg());
        return false;
    }

    if (isset($outputArray['Success']) && $outputArray['Success'] === true && isset($outputArray['PaymentURL'])) {
        echo $outputArray['PaymentURL'];

        return $outputArray['PaymentURL'];
    } else {
        error_log('Ссылка не пришла');
        return false;
    }
}




// данные для карточки показа заказа отдельного
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idviewZakaz'])) {
    $idEdit = $_GET['idviewZakaz'];

    $stmt = $connect->prepare('select * from zakazy where id = ?');
    $stmt->bindValue(1, $idEdit, SQLITE3_INTEGER);
    $result = $stmt->execute();
    // $singleTovar = $result->fetchArray(SQLITE3_ASSOC);

    // print_r(getData($result));
};

// $sum = 100;
// $insertedIdZakaz = 200;


// $data = [
//     'Amount' => $sum * 100,
//     'Description' => 'Покупка на сайте Чубик',
//     'OrderId' => $insertedIdZakaz,
//     'TerminalKey' => 1666291526582,
//     'NotificationURL' => 'http://o9290256.beget.tech/app/controllers/orders.php',
//     // 'SuccessURL' => 'http://o9290256.beget.tech/',
//     // 'TerminalKey' => '200000000947373',
//     // 'TerminalKey' => '24940571',
//     'Password' => 'dg62xis3uaurlk9s',
// ];

// ksort($data);

// $values = array_values($data);

// // print_r($values);

// $concatString = implode('', $values);
// $hashString = hash('sha256', $concatString);

// $data['Token'] = $hashString;
// $data['DATA'] = json_decode(json_encode(['order_number' => $insertedIdZakaz])); // делаем JSON, а из него объект
// // print_r($data['DATA']);



// // echo $data['DATA'];
// unset($data['Password']);

// $postCurl = json_encode($data);

// настраиваем curl 

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://securepay.tinkoff.ru/v2/Init');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $postCurl);
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     'Content-Type: application/json',
//     'Content-Length: ' . strlen($postCurl)
// ]);

// $output = curl_exec($ch);
// $httpHDRS = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// curl_close($ch);

// if ($output === false || $httpHDRS !== 200) {
//     error_log('не удалось выполнить запрос, http код ' . $httpHDRS);
//     return false;
// }

// $outputArray = json_decode($output, true);

// if ($output === false || $httpHDRS !== 200) {
//     echo ('не удалось выполнить запрос, http код ' . $httpHDRS);
//     return false;
// }

// $outputArray = json_decode($output, true);

// print_r($outputArray);

// if (json_last_error() !== JSON_ERROR_NONE) {
//     echo ('Ошибка при декодировании массива' . json_last_error_msg());
//     return false;
// }

// if (
//     isset($outputArray['Success']) && $outputArray['Success'] === true
//     && isset($outputArray['PaymentURL'])
// ) {

//     // echo $outputArray['PaymentURL'];
//     header('Location: ' . $outputArray['PaymentURL']);
// } else {
//     echo ("Ссылка не пришла");
//     return false;
// }
