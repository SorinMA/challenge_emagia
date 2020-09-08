<?php
namespace appemag\app\models;

use appemag\app\models\SkillIdentifier;
use appemag\app\models\Creatura;
use appemag\app\models\Orderus;


final class Game {

    private $orderus_stats;
    private $orderus_skills_atack;
    private $orderus_skills_protec;
    private $creatura_stats;
    private $start_orderus;
    private $turns = 20;

    public function __construct(Orderus $orderus, Creatura $creatura) {
        $this->orderus_stats = $orderus->get_status();
        // nu uita .get_skills() l;a orderus
        $this->creatura_stats = $creatura->get_status();

        // extract skills

        $skills = $orderus->get_skills();
        $this->orderus_skills_atack = array();
        $this->orderus_skills_protec = array();

        foreach($skills as &$skill) {
            if ($skill->get_type()) {
                array_push($this->orderus_skills_atack, $skill);
            } else {
                array_push($this->orderus_skills_protec, $skill);
            }
        }
        
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

    private function get_chance_to_hit() {
        return rand(0, 100);
    }

    private function get_skills_that_have_chance($skills) {
        $res = array();
        foreach($skills as &$skill) {
            if($this->get_chance_to_hit() <= $skill->get_sansa()) {
                array_push($res, $skill);
            }
        }
        return $res;
    }

    private function get_params($skills) {
        // 3 skills indentifiers
        $X1 = new SkillIdentifier(false, 1, 1);
        $X2 = new SkillIdentifier(false, 2, 1);
        $X3 = new SkillIdentifier(false, 3, 0);

        foreach($skills as &$skill) {
            $skill_identifier = $skill->multiplicator_dmg();

            $operation = $skill_identifier->get_operation();
            $quantity = $skill_identifier->get_quantity();

            if ($operation == 1) {
                $X1->set_qunatity($X1->get_quantity() + $quantity);
            }

            if ($operation == 2) {
                $X2->set_qunatity($X2->get_quantity() + $quantity);
            }

            if ($operation == 3) {
                $X3->set_qunatity($X3->get_quantity() + $quantity);
            }
        }

        return array($X1, $X2, $X3);
        
    }

    private function runda() : bool {
        $chance = $this->get_chance_to_hit();
        echo '<br/>';
        echo "Runda:" . $this->turns . "!";

        if ($this->start_orderus) {
            if ($chance > $this->creatura_stats->get_luck()) {
                $atack_skills = $this->get_skills_that_have_chance($this->orderus_skills_atack);
                
                $skills_identifier_sumary = $this->get_params($atack_skills);
                
                $X1 = $skills_identifier_sumary[0];
                $X2 = $skills_identifier_sumary[1];
                $X3 = $skills_identifier_sumary[2];

                echo "creatura hp go from" . $this->creatura_stats->get_health() . '->';
                $dmg = $X1 * ($X2 * ($this->orderus_stats->get_strength() + $X3) - 
                       $this->creatura_stats->get_defence());
                $new_health = $this->creatura_stats->get_health() - 
                              ($dmg >= 0 ? $dmg : 0);;
                $this->creatura_stats->set_health($new_health);
                echo " to " . $new_health ;
                if ($new_health <= 0) {
                    echo '<br/>';
                    echo '<br/>';   
                    echo "win orderus";
                    return true;
                }
            } else {
                echo "orderus hit miss";
            }

        } else {
            if ($chance > $this->orderus_stats->get_luck()) {
                $protec_skills = $this->get_skills_that_have_chance($this->orderus_skills_protec);
                $skills_identifier_sumary = $this->get_params($protec_skills);
                
                $X1 = $skills_identifier_sumary[0];
                $X2 = $skills_identifier_sumary[1];
                $X3 = $skills_identifier_sumary[2];

                echo "orderus hp go from" . $this->orderus_stats->get_health() . '->';
                $dmg = $X1 * ($this->creatura_stats->get_strength()) - 
                       $X2 * ($this->orderus_stats->get_defence() + $X3);
                $new_health = $this->orderus_stats->get_health() - 
                              ($dmg >= 0 ? $dmg : 0);
                $this->orderus_stats->set_health($new_health);
                echo " to " . $new_health ;
                if ($new_health <= 0) {
                    echo '<br/>';
                    echo '<br/>';
                    echo "win creatura";
                    return true;
                }
            } else {
                echo "creatura hit miss";
            }

        }

        $this->start_orderus = !$this->start_orderus;
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
        echo "--------<br>";
        var_dump($this->orderus_skills_atack);
        echo "<br>";
        var_dump($this->orderus_skills_protec);
        echo "<br>------<br>";
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