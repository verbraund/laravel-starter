<?php

namespace App\Repositories\Interfaces;

use App\Models\Setting;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    public function findByName(string $name): ?Setting;
}