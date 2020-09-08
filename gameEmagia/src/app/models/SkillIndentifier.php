<?php
namespace appemag\app\models;

class SkillIdentifier {
    private $type;
    private $operation;
    private $qunatity;

    public function __construct(bool $type, int $operation, int $qunatity) {
        $this->$type = $type;
        $this->$operation = $operation;
        $this->qunatity = $qunatity;
    }

    public function get_type(): bool {
        return $this->type;
    }

    public function get_operation(): int {
        return $this->operation;
    }

    public function get_quantity(): int {
        return $this->quantity;
    }

    public function set_qunatity(int $quantity) {
        $this->quantity = $quantity;
    }
}

?>