<?php

namespace App\Enums;

use Essa\APIToolKit\Enum\Enum;

class ActionTypes extends Enum
{
    public const CREATED = 'created';

    public const UPDATED = 'updated';

    public const DELETED = 'deleted';
}
