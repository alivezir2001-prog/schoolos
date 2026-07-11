<?php

namespace App\Core\Authorization;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Authorization
{
    public static function user(): ?User
    {
        return Auth::user();
    }

    public static function role(): ?string
    {
        return self::user()?->role?->code;
    }

    public static function schoolId(): ?int
    {
        return self::user()?->school_id;
    }

    public static function isSysAdmin(): bool
    {
        return self::role() === Role::SYS_ADMIN;
    }

    public static function isPrincipal(): bool
    {
        return self::role() === Role::PRINCIPAL;
    }

    public static function isTeacher(): bool
    {
        return self::role() === Role::TEACHER;
    }

    public static function isPrincipalOrAdmin(): bool
    {
        return self::isPrincipal() || self::isSysAdmin();
    }
}