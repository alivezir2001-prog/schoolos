<?php

namespace App\Core\Authorization;

use Illuminate\Database\Eloquent\Builder;

class SchoolScope
{
   public static function apply(Builder $query): Builder
{
    $user = Authorization::user();

    if (! $user) {
        return $query;
    }

    if (Authorization::isSysAdmin()) {
        return $query;
    }

    return $query->where('school_id', Authorization::schoolId());
}
}