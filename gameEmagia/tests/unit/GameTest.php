<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use appemag\app\models\Game;
use appemag\app\models\Beast;
use appemag\app\models\Orderus;

final class GameTest extends TestCase
{
    public function test_game(): void
    {
        $i = 10;

        while ($i > 0) {
            $o = new Beast(60, 90, 60, 90, 40, 60, 40, 60, 25, 40);
            $od = new Orderus(70, 100, 70, 80, 45, 55, 40, 50, 10, 30);

            try { 
                $game = new Game($od, $o);
            } catch(Exception $e) {
                break;
            }
            $i -= 1;
        }
        $this->assertEquals(0, $i);
    }
    // eu zic ca ar mai fi cateva teste de facut, dar as depasi deadlineul si sunt si obosit :)
    
}