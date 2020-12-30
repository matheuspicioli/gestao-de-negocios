<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Home()
 * @method static static Work()
 */
final class AddressType extends Enum
{
    const Home = 0;
    const Work = 1;
}
