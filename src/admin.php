<?php

$dsn = "mysql:host=127.0.0.1;dbname=burgerDB;charset=utf8";
$pdo = new PDO($dsn, 'root', '12369874');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$stmt = $pdo->query('SELECT * FROM `users`');
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>База пользователей</h2>
<?php
foreach ($result as $key => $value) {
        echo '<br>';
    foreach ($value as $k => $v) {
        echo $k . ' : '  .$v . '<br>';
    }
}
?>
<?php
$stmt2 = $pdo->query('SELECT * FROM `orders`');
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>
<h2>База заказов</h2>
<?php
foreach ($result2 as $key => $value) {
    echo '<br>';
    foreach ($value as $k => $v) {
        echo $k . ' : '  .$v . '<br>';
    }
}
?>
</body>
</html>