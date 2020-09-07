<?php
namespace appemag\app\models;

use appemag\app\models\Status;

abstract class Skill {
    protected $tip_skill;
    protected $nume_skill;
    protected $sansa;
    protected $Skill;
    
    abstract public function multiplicator_dmg(int $multiplicator_atac, Status $atacator, Status $atacat): Status;

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
        $this->sansa = this->value_formater($sansa);
    }

    abstract public get_skill():Skill;
}
?>