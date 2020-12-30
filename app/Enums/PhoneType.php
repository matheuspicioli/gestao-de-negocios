<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Home()
 * @method static static Work()
 * @method static static WhatsApp()
 */
final class PhoneType extends Enum
{
    const Home     = 0;
    const Work     = 1;
    const WhatsApp = 2;
}
