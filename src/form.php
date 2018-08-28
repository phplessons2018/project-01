<?php

$dsn = "mysql:host=127.0.0.1;dbname=burgerDB;charset=utf8";
$pdo = new PDO($dsn, 'root', '12369874');


$name .= $_POST['name'];
$email .= $_POST['email'];
$phone .= $_POST['phone'];
$street .= $_POST['street'];
$home .= $_POST['home'];
$part .= $_POST['part'];
$appt .= $_POST['appt'];
$floor .= $_POST['floor'];
$comment .= $_POST['comment'];


$takeEmail = $pdo->query("SELECT  `email` FROM `users` WHERE `email` = '$email'");
$makeArray = $takeEmail->fetchAll(PDO::FETCH_ASSOC);

foreach ($makeArray as $key => $value) {
    foreach ($value as $k => $emailFromArray) {
        $emailFromArray;
    }
}

if ($emailFromArray == $email) {

    $pdo->exec("INSERT INTO orders.id_user SELECT id FROM users WHERE email = '$email'");

//    $pdo->exec("SELECT id as email = $email FROM `users` INSERT INTO `orders` (`id_user`, `street`, `home`, `housing`, `flat`, `floor`, `comment` ) VALUES (id.user, '$street', '$home', '$part', '$appt', '$floor', '$comment')");

} else {
    $pdo->exec("INSERT INTO `users` (`name`, `email`, `phone`) VALUES ('$name', '$email', '$phone')");
    echo "Это был первый заказ";
}



echo '<br><br><br>';
$stmt = $pdo->query('SELECT * FROM `users`');
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
echo '<pre>';
print_r($result);





