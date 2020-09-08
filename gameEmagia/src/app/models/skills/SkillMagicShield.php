<?php
namespace appemag\app\models\skills;

use appemag\app\models\Skill;
use appemag\app\models\Status;
use appemag\app\models\SkillStats;

/**
 * class: SkillMagicShield
 * scope:
 *  este o structura de date ce implementeaza clasa Skill, adica e un skill
 *  cu SkillStats false, 1, 2 (adica, e un skill de defence ce scade la jumatate dmg-ul);
 *  clasa este singleton, pentru ca nu are sens sa tot reinitializezi de atatea ori un skill, 
 *  pt e e acelasi.
 * clasa-contine:
 *  - getteri
 *  - constructor cu parametri
 */

final class SkillMagicShield extends Skill {
    
    protected static $skill = null;

    protected function __construct() {
        parent::__construct(false, "Magic Shield", 20);
    }
    public static function get_skill() : Skill {
        if(self::$skill == null) {
            self::$skill = new SkillMagicShield();
        }

        return self::$skill;
    }

    public function dmg_multiplier(): SkillStats {
        return new SkillStats($this->get_type(), 1, 2);
    }
}

?>