<?php

namespace App\Enums;

enum SystemRole: string
{
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case ADMIN = 'ADMIN';
    case MODERATOR = 'MODERATOR';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::MODERATOR => 'Moderator',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Has full access to all system features and settings.n',
            self::ADMIN => 'Manages users, content, and system operations.',
            self::MODERATOR => 'Manages content and monitors guest activity.',
        };
    }
}
