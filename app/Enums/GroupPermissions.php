<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GroupPermissions extends Enum
{
    const USERS = 'users';
    const PERMISSIONS = 'permissions';
}
