<?php
namespace appemag\app\models;

use appemag\app\models\Status;
use appemag\app\models\SkillIdentifier;

abstract class Skill {
    protected $tip_skill;
    protected $nume_skill;
    protected $sansa;
    
    abstract public function multiplicator_dmg(): SkillIdentifier;

    private function value_formater(int $value): int {
        if ($value < 0) {
            return 0;
        }
        if ($value > 100) {
            return 100;
        }
        return $value;
    }

    protected function __construct(bool $tip_skill, string $nume_skill, int $sansa) {
        $this->tip_skill = $tip_skill;
        $this->nume_skill = $nume_skill;
        $this->sansa = $this->value_formater($sansa);
    }

    public function get_type(): bool {
        return $this->tip_skill;
    }

    public function get_nume(): string {
        return $this->nume_skill;
    }

    public function get_sansa(): int {
        return $this->sansa;
    }

    abstract static public function get_skill():Skill;
}
?>