<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Credit()
 * @method static static Debit()
 * @method static static Money()
 */
final class PaymentType extends Enum
{
    const Credit    = 0;
    const Debit     = 1;
    const Money     = 2;
}
