<?php
namespace appemag\app\models;

use appemag\app\models\SkillStats;
use appemag\app\models\Beast;
use appemag\app\models\Orderus;

/**
 * class: Game
 * scope:
 *  este o structura de date ce combina toate structurile de date anterioare + logica jocului
 *  pentru a crea o bAtAlIe EpIcA intre OrderUs si THE Beast
 * clasa-contine:
 *  - getteri si setteri
 *  - constructor cu parametri
 *  - si functiile ce creeaza jocul: who_is_first, start_game si runda
 */
final class Game {

    protected $orderus_stats;
    protected $orderus_skills_atack;
    protected $orderus_skills_protec;
    protected $beast_stats;
    protected $start_orderus;
    protected $turns = 20;

    public function __construct(Orderus $orderus, Beast $beast) {
        // se extrag statusurile pentru creaturi
        $this->orderus_stats = $orderus->get_status();
        $this->beast_stats = $beast->get_status();

        // se extrag skillurile si se separa in skilluri de atac si de protec
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
        
        // se alege cel ce incepe primul, folosind parametrul functiei
        // start_orderus care cand este true, ataca Orderus si cand e false
        // ataca THE Beast
        $this->who_is_first();

        // se incepe jocul
        $this->start_game();
    }

    public function get_orderus_stats() {
        return $this->orderus_stats;
    }

    public function get_beast_stats() {
        return $this->beast_stats;
    }

    /**
     * functia care pe baza vitezei si a norocului 
     * decide cine incepe primul
     */
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

    /**
     * functie care genereaza o sansa (intre 0 si 100),
     * sansa este folosita pentru a sti daca un atac 
     * va lovi sau nu
     */
    private function get_chance_to_hit() {
        return rand(0, 100);
    }

    /**
     * aceasta functie extrage skillurile ce urmeaza sa fie folosite intr-o runda,
     * ia fiecare skill (ori de protec ori de atac, in functie de ipostaza lui Orderus 
     * de atacant sau de victima) si pentru fiecare skill de cu zarul (get_chance_to_hit())
     * si daca zarul e mai mic decat sansa skillului, acel skill va putea fi folosit acea runda
     */
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

    /**
     * aceasta functie genereaza 3 variabile auxiliare
     * $X1, $X2 si $X3 ce reprezinta 3 instante a clasei SkillStats
     * fiecare instanta fiind facuta pentri fiecare tip de operatia
     * si aceste auxiliare, pentru fiecare skill in parte, se vor acumula
     * qunatity-urile skillurilor in aceste variabile auxiliare
     * creand un fel de sumar pentru lupta.
     */
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

    /**
     * runda, este functai principala a jocului si alterneaza intre momentul in care Orderus
     * e atacant si cand Orderus e victima.
     */
    private function runda() : bool {
        $chance = $this->get_chance_to_hit();
        echo '<br/>';
        echo "<h3 style='color:green'>Round: " . (21 - $this->turns) . " -------------- </h3>";

        if ($this->start_orderus) {
            echo "<br/><h4 style='color:green'>Orderus will attack!</h4><br/>";
            if ($chance > $this->beast_stats->get_luck()) {
                // identifica skillurile ce au sansa de a fi date
                $atack_skills = $this->get_skills_that_have_chance($this->orderus_skills_atack);
                
                // genereaza summary pentru skilluri 
                $skills_identifier_sumary = $this->get_params($atack_skills);
                
                $X1 = $skills_identifier_sumary[0]->get_quantity();
                $X2 = $skills_identifier_sumary[1]->get_quantity();
                $X3 = $skills_identifier_sumary[2]->get_quantity();

                // pe baza summaryului se calculeaza dmg ul
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
                    echo "<h1 style='color:blue'>OrderUs WON</h1>";
                    // daca Orderus nu mai are viata, a castiga Beast
                    return true;
                }
            } else {
                echo "<h4 style='color:cyan'>OrderUs missed the attack!</h4>";
            }

        } else {
            echo "<br/><h4 style='color:green'>THE Beast will attack!</h4><br/>";
            if ($chance > $this->orderus_stats->get_luck()) {
                // identifica skillurile ce au sansa de a fi date
                $protec_skills = $this->get_skills_that_have_chance($this->orderus_skills_protec);
                // genereaza summary pentru skilluri 
                $skills_identifier_sumary = $this->get_params($protec_skills);
                
                $X1 = $skills_identifier_sumary[0]->get_quantity();
                $X2 = $skills_identifier_sumary[1]->get_quantity();
                $X3 = $skills_identifier_sumary[2]->get_quantity();
                
                // pe baza summaryului se calculeaza dmg ul
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
                    // daca Beast nu mai are viata, a castiga Orderus
                    return true;
                }
            } else {
                echo "<h4 style='color:pirple'>THE Beast missed the attack!</h4>";
            }

        }

        // aici se face alternare intre cine ataca si cine e vitima
        $this->start_orderus = !$this->start_orderus;
        return false;

    }

    /**
     * o functie ce se ocupa cu formatarea finalului de joc (nesemnificativa :))
     */
    private function final_joc() {
        if ($this->turns == 0) {
            echo "<h2 style='color:yellow'> TIE </h2>";
        } else {
            echo "<h2 style='color:green'>-- Game Over -- </h2>";
        }
    }

    /**
     * functia ce proneste FSM-ul (jocul), o bucla infinita oprita fie de
     * castigul uneia dintre creaturi fie prin finalizara a 20 de runde.
     */
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