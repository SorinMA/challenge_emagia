<?php
require "vendor/autoload.php";
use appemag\app\models\Creatura;
use appemag\app\models\Orderus;
use appemag\app\models\Game;
$o = new Creatura(1, 10, 2, 100, 4, 100, 6, 300, 4, 100);
$od = new Orderus(1, 10, 2, 100, 4, 100, 6, 300, 4, 100);
echo "\n";
$game = new Game($od, $o);

?>