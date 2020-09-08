<?php
namespace appemag\app\models;

use appemag\app\models\StatusInterval;
use appemag\app\models\Status;

/**
 * class: Beast
 * scope:
 *  este o structura de date ce sedimenteaza forma unei creaturi,
 *  o creatura standard are doar status.
 * clasa-contine:
 *  - getteri
 *  - constructor cu parametri
 */
class Beast {
    private $status;
    public function __construct(int $health_low, int $health_high,
                                int $strength_low, int $strength_high,
                                int $defence_low, int $defence_high,
                                int $speed_low, int $speed_high,
                                int $luck_low, int $luck_high) {
        
        $interval = new StatusInterval($health_low, $health_high,
                            $strength_low, $strength_high,
                            $defence_low, $defence_high,
                            $speed_low, $speed_high,
                            $luck_low, $luck_high);

        $this->status = $interval->get_random_status();
    }

    public function get_status(): Status {
        return $this->status;
    }
}

?>