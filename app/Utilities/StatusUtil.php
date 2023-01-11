<?php

namespace App\Utilities;

enum StatusUtil: string
{
    case ACTIVE = 'active';
    case IN_ACTIVE = 'in_active';
    case PENDING = 'pending';
}