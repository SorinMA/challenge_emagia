<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use appemag\app\models\Status;

final class StatusTest extends TestCase
{
    public function testConstructorsAndGettersAndSetters(): void
    {
        $dummy = new Status(-1, 33, 100, 44, -22);

        $health = $dummy->get_health();

        $luck = $dummy->get_luck();

        $dummy->set_speed(1111);
        
        $speed = $dummy->get_speed();

        $this->assertEquals(1111,$speed);
    }

    public function testConstructorsAndGettersAndSetters1(): void
    {
        $dummy = new Status(-1, 33, 100, 44, -22);

        $health = $dummy->get_health();

        $luck = $dummy->get_luck();

        $dummy->set_speed(1111);
        
        $speed = $dummy->get_speed();

        $this->assertEquals(0,$health);
        
    }

    public function testConstructorsAndGettersAndSetters2(): void
    {
        $dummy = new Status(-1, 33, 100, 44, 2222);

   
        $luck = $dummy->get_luck();


        
        $this->assertEquals(100,$luck);
    }
}