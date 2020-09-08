<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use appemag\app\models\StatusInterval;

final class StatusIntervalTest extends TestCase
{
    public function test_constructor(): void
    {
        $i = 10;
        while ($i > 0) {
            $dummy1 = new StatusInterval(-1, 101, -1, 101, -1, 101, -1, 101, -1, 101);
            $dummy2 = new StatusInterval(4, 10, 4, 10, 4, 10, 10, 4, 4, 10);

            $status1 = $dummy1->get_random_status();
            $status2 = $dummy2->get_random_status();

            $this->assertGreaterThanOrEqual(0,$status1->get_health());
            $this->assertGreaterThanOrEqual(0,$status1->get_strength());
            $this->assertGreaterThanOrEqual(0,$status1->get_defence());
            $this->assertGreaterThanOrEqual(0,$status1->get_speed());
            $this->assertGreaterThanOrEqual(0,$status1->get_luck());

            $this->assertLessThanOrEqual(101,$status1->get_health());
            $this->assertLessThanOrEqual(101,$status1->get_strength());
            $this->assertLessThanOrEqual(101,$status1->get_defence());
            $this->assertLessThanOrEqual(101,$status1->get_speed());
            $this->assertLessThanOrEqual(100,$status1->get_luck());

            $this->assertGreaterThanOrEqual(4,$status2->get_health());
            $this->assertGreaterThanOrEqual(4,$status2->get_strength());
            $this->assertGreaterThanOrEqual(4,$status2->get_defence());
            $this->assertGreaterThanOrEqual(3,$status2->get_speed());
            $this->assertGreaterThanOrEqual(4,$status2->get_luck());

            $this->assertLessThanOrEqual(10,$status2->get_health());
            $this->assertLessThanOrEqual(10,$status2->get_strength());
            $this->assertLessThanOrEqual(10,$status2->get_defence());
            $this->assertLessThanOrEqual(4,$status2->get_speed());
            $this->assertLessThanOrEqual(10,$status2->get_luck());
            $i -= 1;
        }
    }
}