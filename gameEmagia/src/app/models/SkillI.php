<?php
namespace appemag\app\models;

class SkillI {
    private $type;
    private $operation;
    private $qunatity;

    public function __construct(bool $type, int $operation, int $qunatity) {
        $this->$type = $type;
        $this->$operation = $operation;
        $this->qunatity = $qunatity;
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

    public function set_qunatity(int $quantity) {
        $this->quantity = $quantity;
    }
}

?>