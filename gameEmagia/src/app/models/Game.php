<?php
namespace appemag\app\models;

use appemag\app\models\SkillStats;
use appemag\app\models\Beast;
use appemag\app\models\Orderus;


final class Game {

    protected $orderus_stats;
    protected $orderus_skills_atack;
    protected $orderus_skills_protec;
    protected $beast_stats;
    protected $start_orderus;
    protected $turns = 20;

    public function __construct(Orderus $orderus, Beast $beast) {
        $this->orderus_stats = $orderus->get_status();
        $this->beast_stats = $beast->get_status();
        
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

    public function get_orderus_stats() {
        return $this->orderus_stats;
    }

    public function get_beast_stats() {
        return $this->beast_stats;
    }

    private function who_is_first() {
        $orderus_speed = $this->orderus_stats->get_speed();
        $creatura_speed = $this->beast_stats->get_speed();

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
        $skills_string = "";
        foreach($skills as &$skill) {
            if($this->get_chance_to_hit() <= $skill->get_chance()) {
                $skills_string = $skills_string . $skill->get_name() . "; ";
                array_push($res, $skill);
            }
        }
        if ($skills_string != "") {
            echo "<h4 style='color:brown'>  Orderus uses this round: " . $skills_string . ' </h4> </br>';
        }
        return $res;
    }

    private function get_params($skills) {
        // 3 skills indentifiers
        $X1 = new SkillStats(false, 1, 1);
        $X2 = new SkillStats(false, 2, 1);
        $X3 = new SkillStats(false, 3, 0);
        
        foreach($skills as $skill) {
            $skill_identifier = $skill->dmg_multiplier();

            $operation = $skill_identifier->get_operation();
            $quantity = $skill_identifier->get_quantity();
            
            if ($operation == 1) {
                $X1->set_qunatity($X1->get_quantity() * $quantity);
            }

            if ($operation == 2) {
                $X2->set_qunatity($X2->get_quantity() * $quantity);
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
        echo "<h3 style='color:green'>Round: " . (21 - $this->turns) . " -------------- </h3>";

        if ($this->start_orderus) {
            echo "<br/><h4 style='color:green'>Orderus will attack!</h4><br/>";
            if ($chance > $this->beast_stats->get_luck()) {
                $atack_skills = $this->get_skills_that_have_chance($this->orderus_skills_atack);
                
                $skills_identifier_sumary = $this->get_params($atack_skills);
                
                $X1 = $skills_identifier_sumary[0]->get_quantity();
                $X2 = $skills_identifier_sumary[1]->get_quantity();
                $X3 = $skills_identifier_sumary[2]->get_quantity();

                
                $dmg = $X1 * ($X2 * ($this->orderus_stats->get_strength() + $X3) - 
                       $this->beast_stats->get_defence());
                $new_health = $this->beast_stats->get_health() - 
                              ($dmg >= 0 ? $dmg : 0);
                echo "<h4 style='color:red'>(dmg dealt: " . ($dmg >= 0 ? $dmg : 0) . ") beast hp go from " . $this->beast_stats->get_health() . ' -> ';
                $this->beast_stats->set_health($new_health);
                echo " to " . $new_health . "</h4>";
                if ($new_health <= 0) {
                    echo '<br/>';
                    echo '<br/>';   
                    echo "<h1 style='color:blue'>OrderUs WON</h1>";;
                    return true;
                }
            } else {
                echo "<h4 style='color:cyan'>OrderUs missed the attack!</h4>";
            }

        } else {
            echo "<br/><h4 style='color:green'>THE Beast will attack!</h4><br/>";
            if ($chance > $this->orderus_stats->get_luck()) {
                $protec_skills = $this->get_skills_that_have_chance($this->orderus_skills_protec);
                $skills_identifier_sumary = $this->get_params($protec_skills);
                
                $X1 = $skills_identifier_sumary[0]->get_quantity();
                $X2 = $skills_identifier_sumary[1]->get_quantity();
                $X3 = $skills_identifier_sumary[2]->get_quantity();
                echo " " . $X1;
                $dmg = ($this->beast_stats->get_strength() - 
                       $X2 * ($this->orderus_stats->get_defence() + $X3)) / $X1;
                $new_health = $this->orderus_stats->get_health() - 
                              ($dmg >= 0 ? $dmg : 0);
                              echo "<h4 style='color:blue'>(dmg dealt: " . ($dmg >= 0 ? $dmg : 0) . ") orderus hp go from " . $this->orderus_stats->get_health() . ' -> ';
                $this->orderus_stats->set_health($new_health);
                echo " to " . $new_health . "</h4>";
                if ($new_health <= 0) {
                    echo '<br/>';
                    echo '<br/>';
                    echo "<h1 style='color:red'>Beast WON :(</h1>";
                    return true;
                }
            } else {
                echo "<h4 style='color:pirple'>THE Beast missed the attack!</h4>";
            }

        }

        $this->start_orderus = !$this->start_orderus;
        return false;

    }

    private function final_joc() {
        if ($this->turns == 0) {
            echo "<h2 style='color:yellow'> TIE </h2>";
        } else {
            echo "<h2 style='color:green'>-- Game Over -- </h2>";
        }
    }

    private function start_game() {
        echo "<h1> Orderus stats: </h1><br>";
        echo $this->get_orderus_stats()->get_status_formated();

        echo "<h1> THE Beast stats: </h1><br>";
        echo $this->get_beast_stats()->get_status_formated();
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