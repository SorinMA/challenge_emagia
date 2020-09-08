<?php
namespace appemag\app\models;

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
        $this->quantity = $quantity;
    }

    public function set_type(int $type) {
        $this->type = $type;
    }

    public function set_operation(int $operation) {
        $this->operation = $operation;
    }
}

?>