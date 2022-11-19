e<?php
require "vendor/autoload.php";
use Endroid\QrCode\QrCode;
$qrcode = new QrCode($_GET['text']);
header("Content-Type: image/png");
echo $qrcode->writeString();
die();