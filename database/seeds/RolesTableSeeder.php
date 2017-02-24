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
        	['name' => 'Администратор',
            'internal_name' => 'appadmin']
        );

        Role::updateOrCreate(
        	['name' => 'Админастратор управления',
            'internal_name' => 'depadmin']
        );

        Role::updateOrCreate(
            ['name' => 'Админастратор учреждения',
            'internal_name' => 'instadmin']
        );

        Role::updateOrCreate(
            ['name' => 'Специалист учреждения',
            'internal_name' => 'instspec']
        );
    }
}
