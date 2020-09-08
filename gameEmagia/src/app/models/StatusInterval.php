<?php
namespace appemag\app\models;
use appemag\app\models\Status;
use appemag\app\models\helpers\HelperValuesFormater;

/**
 * class: StatusInterval
 * scope:
 *  este o structura de date ce are rolul de a manageui intervalele utilizate pentru
 *  selectia statusurilor
 * clasa-contine:
 *  - setteri
 *  - constructor cu parametri
 *  - o functie (get_random_status()) ce returneaza un obiect de tipul Status
 * 
 */
class StatusInterval {
    protected $health_low;
    protected $health_high;

    protected $strength_low;
    protected $strength_high;

    protected $defence_low;
    protected $defence_high;

    protected $speed_low;
    protected $speed_high;

    protected $luck_low;
    protected $luck_high;

    /**
     * functia genereaza un obiect de tipul Status folosind functia rand
     * pentru fiecare interval generand o valoare random in acel interval.
     */
    function get_random_status() : Status {
        $rand_health = rand($this->health_low, $this->health_high);
        $rand_strength = rand($this->strength_low, $this->strength_high);
        $rand_defence = rand($this->defence_low, $this->defence_high);
        $rand_speed = rand($this->speed_low, $this->speed_high);
        $rand_luck = rand($this->luck_low, $this->luck_high);
        return new Status($rand_health, $rand_strength, $rand_defence, $rand_speed, $rand_luck);
    }

    function __construct(int $health_low, int $health_high,
                         int $strength_low, int $strength_high,
                         int $defence_low, int $defence_high,
                         int $speed_low, int $speed_high,
                         int $luck_low, int $luck_high) {
        $health = HelperValuesFormater::interval_formater($health_low, $health_high, false);
        $strength = HelperValuesFormater::interval_formater($strength_low, $strength_high, false);
        $defence = HelperValuesFormater::interval_formater($defence_low, $defence_high, false);
        $speed = HelperValuesFormater::interval_formater($speed_low, $speed_high, false);
        $luck = HelperValuesFormater::interval_formater($luck_low, $luck_high, true);
        
        $this->set_health($health[0], $health[1]);
        $this->set_strength($strength[0], $strength[1]);
        $this->set_defence($defence[0], $defence[1]);
        $this->set_speed($speed[0], $speed[1]);
        $this->set_luck($luck[0], $luck[1]);

    }
    
    protected function set_health(int $low, int $high) {
        $this->health_low = $low;
        $this->health_high = $high;
    }

    protected function set_strength(int $low, int $high) {
        $this->strength_low = $low;
        $this->strength_high = $high;
    }

    protected function set_defence(int $low, int $high) {
        $this->defence_low = $low;
        $this->defence_high = $high;
    }

    protected function set_speed(int $low, int $high) {
        $this->speed_low = $low;
        $this->speed_high = $high;
    }

    protected function set_luck(int $low, int $high) {
        $this->luck_low = $low;
        $this->luck_high = $high;
    }
    
}

?>