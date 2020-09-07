<?php
namespace appemag\app\models;

use appemag\app\models\Creatura;
use appemag\app\models\Orderus;

final class Game {

    private $orderus_stats;
    private $orderus_skills;
    private $creatura_stats;
    private $start_orderus;
    private $turns = 20;

    public function __construct(Orderus $orderus, Creatura $creatura) {
        $this->orderus_stats = $orderus->get_status();
        // nu uita .get_skills() l;a orderus
        $this->creatura_stats = $creatura->get_status();

        
        $this->who_is_first();
        $this->start_game();
    }

    private function who_is_first() {
        $orderus_speed = $this->orderus_stats->get_speed();
        $creatura_speed = $this->creatura_stats->get_speed();

        $orderus_luck = $this->orderus_stats->get_luck();
        $creatura_luck = $this->orderus_stats->get_luck();

        if ($orderus_speed > $creatura_speed ||
            ($orderus_speed == $creatura_speed && $orderus_luck >= $creatura_luck)) {
            $this->start_orderus = true;
        } else {
            $this->start_orderus = false;
        }
    }

    private function runda() : bool {
        return false;
    }

    private function final_joc() {
        if ($this->turns == 0) {
            echo "EQ";
        } else {
            echo "WINER";
        }
    }

    private function start_game() {
        while (true) {
            $info_runda = $this->runda();
            
            if ($info_runda) {
                $this->final_joc();
                break;
            }
            if ($this->turns == 1) {
                $this->turns -= 1;
                $this->final_joc();
                break;
            }
            $this->turns -= 1;
        }
    }

}

?>