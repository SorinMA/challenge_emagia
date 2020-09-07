<?php
namespace appemag\app\models;

use appemag\app\models\Creatura;

class Orderus extends Creatura{
    public function __construct(int $health_low, int $health_high,
                                int $strength_low, int $strength_high,
                                int $defence_low, int $defence_high,
                                int $speed_low, int $speed_high,
                                int $luck_low, int $luck_high) {
        
        parent::__construct($health_low, $health_high,
                            $strength_low, $strength_high,
                            $defence_low, $defence_high,
                            $speed_low, $speed_high,
                            $luck_low, $luck_high);
    }
    # skilss !!!
}
?>