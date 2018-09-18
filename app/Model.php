<?php
namespace App;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use PDO;

class Model
{

    public function swift($data)
    {
        $sql = "SELECT `id` FROM `users` WHERE `email` = '" . $data['email'] . "'";
        $sth = $this->connect()->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT MAX(`id`) as maxId FROM `orders` WHERE `id_user` = '$result[id]'";
        $getId = $this->connect()->prepare($sql);
        $getId->execute();
        $resultId = $getId->fetch(PDO::FETCH_ASSOC);


        $transport = (new Swift_SmtpTransport('smtp.yandex.ru', 465, 'ssl'))
            ->setUsername('proektabc2@yandex.ru')
            ->setPassword('abcabc2');
        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message("Ваш заказ № $resultId[maxId]"))
            ->setFrom(['proektabc2@yandex.ru' => 'Stas'])
            ->setTo(['stanislav.dimitrenko@gmail.com' => "$data[name]"])
            ->setBody("Имя: $data[name] \"\n \n\" email: $data[email] \"\n \n\" Телефон: $data[phone]");
        $result = $mailer->send($message);
        echo "Cообщение отправленно";
    }

    public function connect()
    {
        $dsn = "mysql:host=127.0.0.1;dbname=burgerDB;charset=utf8";
        return $pdo = new PDO($dsn, 'root', '12369874');
    }


    public function post($data)
    {
        $sql = "SELECT `id` FROM `users` WHERE `email` = '" . $data['email'] . "'";
        $sth = $this->connect()->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            $sql = "INSERT INTO `users`(`name`, `email`, `phone`) VALUES ('" . $data['name'] . "' ,'" . $data['email'] . "','" . $data['phone'] . "');";

            $sth = $this->connect()->prepare($sql);
            $sth->execute();

            $sql = "SELECT `id` FROM `users` WHERE `email` = '" . $data['email'] . "'";
            $sth = $this->connect()->prepare($sql);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);

        }
        $sql = "INSERT INTO `orders` (`id_user`, `name`, `street`, `home`, `housing`, `flat`, `floor`, `comment`) VALUES ('$result[id]', '" . $data['name'] . "', '" . $data['street'] . "', '" . $data['home'] . "', '" . $data['part'] . "', '" . $data['appt'] . "', '" . $data['floor'] . "', '" . $data['comment'] . "');";
        $sth = $this->connect()->prepare($sql);
        $sth->execute();
    }


}






