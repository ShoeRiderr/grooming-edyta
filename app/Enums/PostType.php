<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static DOG_HOTEL()
 * @method static static PHYSIOTHERAPY()
 * @method static static GROOMING()
 */
final class PostType extends Enum
{
    const DOG_HOTEL =   0;
    const PHYSIOTHERAPY =   1;
    const GROOMING = 2;
}
