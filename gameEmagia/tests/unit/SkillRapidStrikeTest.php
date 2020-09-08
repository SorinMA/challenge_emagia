<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use appemag\app\models\skills\SkillRapidStrike;

final class SkillRapidStrikeTest extends TestCase
{
    public function test_class(): void
    {
        $dummy1 = SkillRapidStrike::get_skill();
        $dummy2 = SkillRapidStrike::get_skill();

        $this->assertEquals($dummy1, $dummy2);
    }
}