<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Enums\Setting as SettingEnum;
use Illuminate\Database\Seeder;

class SystemConfigSeeder extends Seeder
{

    public function run(): void
    {
        Setting::updateOrCreate(
            ['name' => SettingEnum::AUTH_TTL->value],
            [
                'group' => 'system',
                'type' => 'integer',
                'value' => '1440',
                'label' => 'Час сесії користувача',
                'description' => 'Час життя сесії користувача в хвилинах(TTL)',
            ]
        );
    }
}
