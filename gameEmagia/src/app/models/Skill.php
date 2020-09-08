<?php
namespace appemag\app\models;

use appemag\app\models\Status;
use appemag\app\models\SkillStats;
use appemag\app\models\helpers\HelperValuesFormater;

abstract class Skill {
    protected $type_skill;
    protected $name_skill;
    protected $chance;
    
    abstract public function dmg_multiplier(): SkillStats;
    abstract static public function get_skill():Skill;

    protected function __construct(bool $type_skill, string $name_skill, int $chance) {
        $this->type_skill = $type_skill;
        $this->name_skill = $name_skill;
        $this->chance = HelperValuesFormater::value_formater($chance, true);
    }

    public function get_type(): bool {
        return $this->type_skill;
    }

    public function get_name(): string {
        return $this->name_skill;
    }

    public function get_chance(): int {
        return $this->chance;
    }
}
?>