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

    public function get_health() {
        return $this->health;
    }

    public function get_strength() {
        return $this->strength;
    }

    public function get_defence() {
        return $this->defence;
    }

    public function get_speed() {
        return $this->speed;
    }

    public function get_luck() {
        return $this->luck;
    }
}

?>