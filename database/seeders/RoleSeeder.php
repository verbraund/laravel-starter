<?php

namespace Database\Seeders;

use App\Enums\SystemRole;
use App\Models\Access\Permission;
use App\Models\Access\Resource;
use App\Models\Access\Role;
use App\Models\File;
use App\Models\Image;
use App\Models\Setting;
use App\Models\Todo\Category;
use App\Models\Todo\Todo;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {

        //---- Permissions ---------------------------------/
        $view = Permission::updateOrCreate(['name' => 'view'], ['label' => 'Перегляд']);
        $create = Permission::updateOrCreate(['name' => 'create'], ['label' => 'Створення']);
        $edit = Permission::updateOrCreate(['name' => 'update'], ['label' => 'Зміна']);
        $delete = Permission::updateOrCreate(['name' => 'delete'], ['label' => 'Видалення']);


        //---- Resources ---------------------------------/
        $category = Resource::updateOrCreate(['name' => Category::class], ['label' => 'Категорії задач']);
        $todo = Resource::updateOrCreate(['name' => Todo::class], ['label' => 'Задачі']);
        $image = Resource::updateOrCreate(['name' => Image::class], ['label' => 'Картинки']);
        $file = Resource::updateOrCreate(['name' => File::class], ['label' => 'Файли']);
        $user = Resource::updateOrCreate(['name' => User::class], ['label' => 'Користувачі']);
        $role = Resource::updateOrCreate(['name' => Role::class], ['label' => 'Ролі користувачів']);
        //$setting = Resource::updateOrCreate(['name' => Setting::class], ['label' => 'Налаштування']);


        //---- Roles ---------------------------------/
        Role::updateOrCreate(
            ['slug' => SystemRole::SUPER_ADMIN->value],
            [
                'name' => SystemRole::SUPER_ADMIN->label(),
                'description' => SystemRole::SUPER_ADMIN->description(),
                'is_system' => true
            ]
        );

        $admin = Role::updateOrCreate(
            ['slug' => SystemRole::ADMIN->value],
            [
                'name' => SystemRole::ADMIN->label(),
                'description' => SystemRole::ADMIN->description(),
                'is_system' => true
            ]
        );
        $admin->resource($category)->sync([$view, $create, $edit, $delete]);
        $admin->resource($todo)->sync([$view, $create, $edit, $delete]);
        $admin->resource($image)->sync([$view, $create, $edit, $delete]);
        $admin->resource($file)->sync([$view, $create, $edit, $delete]);
        $admin->resource($user)->sync([$view, $create, $edit, $delete]);
        $admin->resource($role)->sync([$view, $create, $edit, $delete]);


        $moderator = Role::updateOrCreate(
            ['slug' => SystemRole::MODERATOR->value],
            [
                'name' => SystemRole::MODERATOR->label(),
                'description' => SystemRole::MODERATOR->description(),
                'is_system' => true
            ]
        );
        $moderator->resource($category)->sync([$view, $create, $edit, $delete]);
        $moderator->resource($todo)->sync([$view, $create, $edit, $delete]);
        $moderator->resource($image)->sync([$view, $create, $edit, $delete]);
        $moderator->resource($file)->sync([$view, $create, $edit, $delete]);

    }
}