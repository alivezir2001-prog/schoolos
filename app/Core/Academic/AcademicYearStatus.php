<?php

namespace App\Core\Academic;

enum AcademicYearStatus: string
{
    case PLANNING = 'PLANNING';

    case ACTIVE = 'ACTIVE';

    case COMPLETED = 'COMPLETED';

    case ARCHIVED = 'ARCHIVED';
}