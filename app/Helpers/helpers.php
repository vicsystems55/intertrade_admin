<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helpers
{
    public static function formatSizeUnits($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function formatCurrencySuffix($num)
    {
        if (!is_numeric($num)) {
            return '₦0';
        }

        if ($num >= 1000000000) {
            return '₦' . round($num / 1000000000, 2) . 'B';
        }

        if ($num >= 1000000) {
            return '₦' . round($num / 1000000, 2) . 'M';
        }

        if ($num >= 1000) {
            return '₦' . round($num / 1000, 2) . 'K';
        }

        return '₦' . number_format($num, 2);
    }
}
