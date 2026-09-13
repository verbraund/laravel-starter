<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected array $repositories = [
        \App\Repositories\Interfaces\ImageRepositoryInterface::class => \App\Repositories\Eloquent\ImageRepository::class,
        \App\Repositories\Interfaces\FileRepositoryInterface::class => \App\Repositories\Eloquent\FileRepository::class,
        \App\Repositories\Interfaces\SettingRepositoryInterface::class => \App\Repositories\Eloquent\SettingRepository::class,
        \App\Repositories\Interfaces\DictionaryRepositoryInterface::class => \App\Repositories\Eloquent\DictionaryRepository::class,
        \App\Repositories\Interfaces\User\UserRepositoryInterface::class => \App\Repositories\Eloquent\User\UserRepository::class,
        \App\Repositories\Interfaces\User\LoginHistoryRepositoryInterface::class => \App\Repositories\Eloquent\User\LoginHistoryRepository::class,
        \App\Repositories\Interfaces\Site\MenuRepositoryInterface::class => \App\Repositories\Eloquent\Site\MenuRepository::class,
        \App\Repositories\Interfaces\Auth\AccessTokenRepositoryInterface::class => \App\Repositories\Eloquent\Auth\AccessTokenRepository::class,
        \App\Repositories\Interfaces\Auth\RefreshTokenRepositoryInterface::class => \App\Repositories\Eloquent\Auth\RefreshTokenRepository::class,
        \App\Repositories\Interfaces\Auth\PasswordResetTokenRepositoryInterface::class => \App\Repositories\Eloquent\Auth\PasswordResetTokenRepository::class,
        \App\Repositories\Interfaces\Admin\MenuRepositoryInterface::class => \App\Repositories\Eloquent\Admin\MenuRepository::class,
        \App\Repositories\Interfaces\Access\RoleRepositoryInterface::class => \App\Repositories\Eloquent\Access\RoleRepository::class
    ];

    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}