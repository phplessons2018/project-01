<?php
require "vendor/autoload.php";

$sendMail = new \App\Send();
$sendMail->swift();
