<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use appemag\app\models\Status;

final class StatusTest extends TestCase
{
    public function test_constructor1(): void
    {
        $dummy = new Status(-1, -1, -1, -1, -1);

        $this->assertEquals(0,$dummy->get_health());
        $this->assertEquals(0,$dummy->get_strength());
        $this->assertEquals(0,$dummy->get_defence());
        $this->assertEquals(0,$dummy->get_speed());
        $this->assertEquals(0,$dummy->get_luck());
    }

    public function test_constructor2(): void
    {
        $dummy = new Status(101, 101, 101, 101, 101);

        $this->assertEquals(101,$dummy->get_health());
        $this->assertEquals(101,$dummy->get_strength());
        $this->assertEquals(101,$dummy->get_defence());
        $this->assertEquals(101,$dummy->get_speed());
        $this->assertEquals(100,$dummy->get_luck());
    }

    public function test_constructor3(): void
    {
        $dummy = new Status(68, 69, 70, 80, 90);

        $this->assertEquals(68,$dummy->get_health());
        $this->assertEquals(69,$dummy->get_strength());
        $this->assertEquals(70,$dummy->get_defence());
        $this->assertEquals(80,$dummy->get_speed());
        $this->assertEquals(90,$dummy->get_luck());
    }

    public function test_get_status_formated(): void
    {
        $i = 10;
        while ($i > 0) {
            $dummy = new Status(68, 69, 70, 80, 90);
            try {
                $aux = $dummy->get_status_formated();
            } catch (Exception $e) {
                break;
            }
            $i -= 1;
        }

        $this->assertEquals(0, $i);
    }

}