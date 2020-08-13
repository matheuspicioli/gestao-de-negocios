<?php

namespace App\Helpers;

class Money {
    public static function moneyToDatabase(string $value): float
    {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);

        return $value;
    }

    public static function databaseToMoney(float $value): string
    {
        return 'R$ '.number_format($value, 2, ',', '.');
    }
}
