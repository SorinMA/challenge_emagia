<?php
namespace appemag\app\models;

use appemag\app\models\Beast;
use appemag\app\models\Skill;
use appemag\app\models\skills\SkillMagicShield;
use appemag\app\models\skills\SkillRapidStrike;

/**
 * class: Orderus
 * scope:
 *  este o structura de date ce extinde forma unei creaturi si adauga optiunea de a avea
 *  skilluri permitand crearea lui Orderus, marele boss din emagia :))
 * clasa-contine:
 *  - getteri si setter pentru skills (optiunea de a agauga noi skilluri)
 *  - constructor cu parametri
 */
class Orderus extends Beast{
    protected $skills = array();
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
                            
        $this->add_skill(SkillMagicShield::get_skill());
        $this->add_skill(SkillRapidStrike::get_skill());
    }

    public function add_skill(Skill $skill) {
        array_push($this->skills, $skill);
    }

    public function get_skills() {
        return $this->skills;
    }
}
?>