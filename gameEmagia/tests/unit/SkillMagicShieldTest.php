<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use appemag\app\models\skills\SkillMagicShield;

final class SkillMagicShieldTest extends TestCase
{
    public function test_class(): void
    {
        $dummy1 = SkillMagicShield::get_skill();
        $dummy2 = SkillMagicShield::get_skill();

        $this->assertEquals($dummy1, $dummy2);
    }
}