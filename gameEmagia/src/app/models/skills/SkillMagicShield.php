<?php
namespace appemag\app\models\skills;

use appemag\app\models\Skill;
use appemag\app\models\Status;
use appemag\app\models\SkillI;

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

    public function multiplicator_dmg(): SkillI {
        return new SkillI($this->get_type(), 1, 2);
    }
}

?>