<?php

$dsn = "mysql:host=127.0.0.1;dbname=burgerDB;charset=utf8";
$pdo = new PDO($dsn, 'root', '12369874');

if (!empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['phone'])) {

    $name .= $_POST['name'];
    $email .= $_POST['email'];
    $phone .= $_POST['phone'];
    $street .= $_POST['street'];
    $home .= $_POST['home'];
    $part .= $_POST['part'];
    $appt .= $_POST['appt'];
    $floor .= $_POST['floor'];
    $comment .= $_POST['comment'];

} else {
    echo "Ошибка: Заполните имя, email и телефон!";
}


str_replace(' ','',$email); // удаляем пробелы
$email = mb_strtolower($email); // приводим к нижнему регистру


$sql = "SELECT `id` FROM `users` WHERE `email` = '$email'"; // получение id пользователя привязанное к email (если есть)
$sth = $pdo->prepare($sql); // подготавливает SQL выражение к выполнению
$sth->execute(); //запускает подготовленный запрос на выполнение
$result = $sth->fetch(PDO::FETCH_ASSOC); // извлекаем следующую строку



// false если емаил не найден
if ($result === false){
    $sql = "INSERT INTO `users`(`name`, `email`, `phone`) VALUES ('$name' ,'$email','$phone');"; // создаем нового пользователя

    $sth = $pdo->prepare($sql);
    $sth->execute();

    $sql = "SELECT `id` FROM `users` WHERE `email` = '$email'";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);

}
$sql = "INSERT INTO `orders` (`id_user`, `name`, `street`, `home`, `housing`, `flat`, `floor`, `comment`) VALUES ('$result[id]', '$name', '$street', '$home', '$part', '$appt', '$floor', '$comment');";
$sth = $pdo->prepare($sql);
$sth->execute();


//взять id заказа
$sql = "SELECT MAX(`id`) as maxId FROM `orders` WHERE `id_user` = '$result[id]'";
$getId = $pdo->prepare($sql);
$getId->execute();
$resultId = $getId->fetch(PDO::FETCH_ASSOC);



//Посчитать колличество заказов
$sql = "SELECT COUNT(*) as number_orders FROM `orders` WHERE `id_user` = '$result[id]'";
$countId = $pdo->prepare($sql);
$countId->execute();
$resultCountId = $countId->fetch(PDO::FETCH_ASSOC);


$userOrders = $resultCountId[number_orders]; // записываем результат


if($userOrders == 1) {
    $sumOrders = 'Спасибо - это ваш первый заказ';
} else {
    $sumOrders = 'Спасибо! Это уже ' . $userOrders . ' заказ';
}

//создаем форму

$getTime = date('d.m.Y H.i'); // фиксируем текущее время

$file = 'file/orders.html';

$title =  '<br><br>' . 'Заказ № ' . $resultId[maxId] . '<br>';
$time = 'Время заказа - ' . $getTime;
$fullAddress = 'Ваш заказ будет доставлен по адресу - ' . ', ' . $street . ', ' . $home . ', ' . $part . ', ' . $appt . ', ' . $floor . '<br>';
$text = 'DarkBeefBurger за 500 рублей, 1 шт' . '<br>';


echo $orderMessage = $title . $time . $fullAddress . $text . $sumOrders;

//Работаем с файлом, добавляя запись

$writeOrder = file_get_contents($file);
$writeOrder .= $orderMessage;

file_put_contents($file, $writeOrder);







