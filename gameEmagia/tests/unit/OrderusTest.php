<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use appemag\app\models\Orderus;
use appemag\app\models\skills\SkillMagicShield;
use appemag\app\models\skills\SkillRapidStrike;
final class OrderusTest extends TestCase
{
    public function test_class(): void
    {
        $od = new Orderus(70, 100, 70, 80, 45, 55, 40, 50, 10, 30);
        
        $this->assertEquals(array(SkillMagicShield::get_skill(), SkillRapidStrike::get_skill()), $od->get_skills());
    }
}