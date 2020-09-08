<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use appemag\app\models\SkillStats;

final class SkillStatsTest extends TestCase
{
    public function test_constructor(): void
    {
        $dummy1 = new SkillStats(true, -1, -1);
        $dummy2 = new SkillStats(false, 4, 0.5);
        $dummy3 = new SkillStats(true, 2, 5);

        $this->assertEquals(true,$dummy1->get_type());
        $this->assertEquals(1,$dummy1->get_operation());
        $this->assertEquals(1,$dummy1->get_quantity());

        $this->assertEquals(false,$dummy2->get_type());
        $this->assertEquals(1,$dummy2->get_operation());
        $this->assertEquals(1,$dummy2->get_quantity());
        echo "-------".$dummy3->get_quantity();
        $this->assertEquals(true,$dummy3->get_type());
        $this->assertEquals(2,$dummy3->get_operation());
        $this->assertEquals(5,$dummy3->get_quantity());
    }
}