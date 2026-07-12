<?php

namespace App\Core\Academic;

enum TeachingAssignmentStatus: string
{
    case PLANNING = 'PLANNING';

    case ACTIVE = 'ACTIVE';

    case COMPLETED = 'COMPLETED';

    case CANCELLED = 'CANCELLED';
}