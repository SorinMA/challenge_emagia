<?php
namespace appemag\app\models;

/**
 * class: SkillStats
 * scope:
 *  este o structura de date ce are rolul de a manageui statusurile unui skill
 *  adica: sunt 3 componente pentru un skill:
 *   - type -> ce indica daca este un skill de ATACK (cand e true) sau DEFENSE (cand e false)
 *   - operation -> ce descrie unde este aplicat multiplicatorul quantity, momentan sunt doar trei variante
 *                  de operation (1, 2 sau 3) si acestea au urmatoarea semnificatie:
 *                         1 - daca formula de dmg este (enemyStrength - yourDefence)
 *                             pe aceasta formula se va aplica multiplicatorul qunatity astfel
 *                             newDMG = quntity * (enemyStrength - yourDefence) in caz ca type = true
 *                             si in caz ce type = false
 *                             newDMG = (enemyStrength - yourDefence) / quntity
 *                         2- formula de dmg este (enemyStrength - yourDefence)
 *                             pe aceasta formula se va aplica multiplicatorul qunatity astfel
 *                             newDMG = (quntity * enemyStrength - yourDefence) in caz ca type = true
 *                             si in caz ce type = false
 *                             newDMG = (enemyStrength - yourDefence * quntity)
 *                         3- formula de dmg este (enemyStrength - yourDefence)
 *                             pe aceasta formula se va aplica multiplicatorul qunatity astfel
 *                             newDMG = ((quntity + enemyStrength) - yourDefence) in caz ca type = true
 *                             si in caz ce type = false
 *                             newDMG = (enemyStrength - (yourDefence + quntity))
 * clasa-contine:
 *  - setteri si getteri
 *  - constructor cu parametri
 *  - o functie (get_random_status()) ce returneaza un obiect de tipul Status
 * 
 */

class SkillStats {
    private $type;
    private $operation;
    private $qunatity;

    public function __construct(bool $type, int $operation, float $qunatity) {
        $this->set_qunatity($qunatity);
        $this->set_type($type);
        $this->set_operation($operation);
    }

    public function get_type() {
        return $this->type;
    }

    public function get_operation() {
        return $this->operation;
    }

    public function get_quantity() {
        return $this->quantity;
    }

    public function set_qunatity(float $quantity) {
        if ($qunatity >= 1) {
            $this->quantity = $quantity;
        } else {
            $this->quantity = 1;
        }
    }

    public function set_type(bool $type) {
        $this->type = $type;
    }

    public function set_operation(int $operation) {
        if ($operation >= 1 && $operation <=3) {
            $this->operation = $operation;
        } else {
            $this->operation = 1;
        }
    }
}

?>