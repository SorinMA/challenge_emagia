<?php
namespace appemag\app\models;

class Status {
    protected $health;
    protected $strength;
    protected $defence;
    protected $speed;
    protected $luck;

    function __construct(int $health, int $strength,int $defence,int $speed,int $luck) {
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
    }

    public function get_health() : int {
        return $this->health;
    }

    public function get_strength() : int {
        return $this->strength;
    }

    public function get_defence() : int {
        return $this->defence;
    }

    public function get_speed() : int {
        return $this->speed;
    }

    public function get_luck() : int {
        return $this->luck;
    }

    private function value_formater(int $value, bool $is_luck): int {
        if ($value < 0) {
            return 0;
        }
        if ($value > 100 && $is_luck) {
            return 100;
        }
        return $value;
    }

    public function set_health(int $health) {
        $this->health = $this->value_formater($health, false);
    }

    public function set_strength(int $strength) {
        $this->strength = $this->value_formater($strength, false);
    }

    public function set_defence(int $defence) {
        $this->defence = $this->value_formater($defence, false);
    }

    public function set_speed(int $speed) {
        $this->speed = $this->value_formater($speed, false);
    }

    public function set_luck(int $luck) {
        $this->luck = $this->value_formater($luck, false);
    }
}

?>