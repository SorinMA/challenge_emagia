<?php
require "vendor/autoload.php";

use appemag\app\models\Beast;
use appemag\app\models\Orderus;
use appemag\app\models\Game;

$o = new Beast(60, 90, 60, 90, 40, 60, 40, 60, 25, 40);
$od = new Orderus(70, 100, 70, 80, 45, 55, 40, 50, 10, 30);

$game = new Game($od, $o);

?>