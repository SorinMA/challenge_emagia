<?php
namespace appemag\app\models\skills;

use appemag\app\models\Skill;
use appemag\app\models\SkillIdentifier;

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

    public function multiplicator_dmg(): SkillIdentifier {
        return new SkillIdentifier($this->get_type(), 1, 2); // 1X 2* 3+
    }
}

?>