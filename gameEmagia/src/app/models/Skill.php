<?php
namespace appemag\app\models;

use appemag\app\models\Status;
use appemag\app\models\SkillStats;
use appemag\app\models\helpers\HelperValuesFormater;

/**
 * class: Skill
 * scope:
 *  este o structura de date abstracta ce are rolul de a fi un blueprint pentru
 *  skilluri precum Rapid Strike si Magic Shield.
 * clasa-contine:
 *  - getteri
 *  - constructor cu parametri
 *  - 2 functii abstracte
 */
abstract class Skill {
    protected $type_skill;
    protected $name_skill;
    protected $chance;
    
    /**
     * aceasta functie ar trebui sa returneze tipul de SkillStats al skillului,
     * adica modul in care da dmg sau modul in care apara
     */
    abstract public function dmg_multiplier(): SkillStats;
    /**
     * aceasta functie ar trebui sa returneze skillul pentru ca se doreste ca clasele 
     * ce doresc sa imepmenteze aceasta clasa abstracta sa fie singleton
     */
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