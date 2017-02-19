<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(
        	['name' => 'Администратор']
        );

        Role::updateOrCreate(
        	['name' => 'Админастратор управления']
        );

        Role::updateOrCreate(
            ['name' => 'Админастратор учреждения']
        );

        Role::updateOrCreate(
            ['name' => 'Специалист учреждения']
        );
    }
}
