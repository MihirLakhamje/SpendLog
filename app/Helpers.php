<?php

if (!function_exists('short_number_format')) {
    function short_number_format($num, $precision = 1) {
        if ($num < 1000) {
            return $num;
        }

        $units = ['K', 'M', 'B', 'T'];
        $unitIndex = 0;

        while ($num >= 1000 && $unitIndex < count($units)) {
            $num /= 1000;
            $unitIndex++;
        }

        return round($num, $precision) . $units[$unitIndex - 1];
    }
}