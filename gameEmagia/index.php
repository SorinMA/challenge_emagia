<?php
require "vendor/autoload.php";
use appemag\app\models\Orderus;

$o = new Orderus();

echo $o::get_hello();
?>