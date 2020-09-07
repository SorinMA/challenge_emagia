<?php
namespace appemag\app\models\skills;

use appemag\app\models\Skill;
use appemag\app\models\Status;

final class SkillMagicShield extends Skill {
    protected function __construct() {
        parent::__construct(false, "Magic Shield", 20);
    }
    public function get_skill() : Skill {
        if(!isset($this->Skill)) {
            $this->Skill = new SkillMagicShield();
        }

        return $this->Skill;
    }

    public function multiplicator_dmg(int $multiplicator_atac, Status $atacator, Status $atacat): Status {
        $atacat_health = $atacat::get_health();
        $atacat_defence = $atacat::get_defence();

        $atacator_strength = $atacator::get_strength();

        multiplicator_atac*(s - d)
        return new Status($atacat_health, $atacat::get_strength(), $atacat_defence, $atacat::get_speed(), $atacat::get_luck());
    }
}

?>