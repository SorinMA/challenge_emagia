<?php
namespace appemag\app\models\skills;

use appemag\app\models\Skill;
use appemag\app\models\SkillStats;

/**
 * class: SkillRapidStrike
 * scope:
 *  este o structura de date ce implementeaza clasa Skill, adica e un skill
 *  cu SkillStats true, 1, 2 (adica, e un skill de atac ce dubleaza dmg-ul);
 *  clasa este singleton, pentru ca nu are sens sa tot reinitializezi de atatea ori un skill, 
 *  pt e e acelasi.
 * clasa-contine:
 *  - getteri
 *  - constructor cu parametri
 */

class SkillRapidStrike extends Skill {
    
    protected static $skill = null;
    
    protected function __construct() {
        parent::__construct(true, "Rapid Strike", 10);
    }
    public static function get_skill() : Skill {
        if(self::$skill == null) {
            self::$skill = new SkillRapidStrike();
        }

        return self::$skill;
    }

    public function dmg_multiplier(): SkillStats {
        return new SkillStats($this->get_type(), 1, 2); 
    }
}

?>