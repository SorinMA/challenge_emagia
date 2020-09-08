<?php
namespace appemag\app\models\helpers;

final class HelperValuesFormater {
    private function __construct() {} // neinstantiabila

    public static function value_formater(int $value, bool $is_luck): int {
        if ($value < 0) {
            return 0;
        }
        if ($value > 100 && $is_luck) {
            return 100;
        }
        return $value;
    }

    public static function interval_formater(int $value_low, int $value_high, bool $is_luck) {
        $value_low = HelperValuesFormater::value_formater($value_low, $is_luck);
        $value_high = HelperValuesFormater::value_formater($value_high, $is_luck);
        if ($value_low > $value_high) {
            $value_low = $value_high - 1;
        }
        return array($value_low, $value_high);
    }
}

?>