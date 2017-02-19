<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::firstOrNew(['username' => 'admin']);
        $admin->displayname = 'Admin';
        $admin->email = 'admin@pam.ru';
        $admin->password = bcrypt(config('seeding.userpasswords.admin'));
        $adminrole = Role::where('name','=','Администратор')->first();
        $admin->role()->associate($adminrole);
        $admin->save();

        $user = User::firstOrNew(['username' => 'user1']);
        $user->displayname = 'User1';
        $user->email = 'user1@pam.ru';
        $user->password = bcrypt(config('seeding.userpasswords.user1'));
        $userrole = Role::where('name','=','Админастратор управления')->first();
        $user->role()->associate($userrole);
        $user->save();

        $user = User::firstOrNew(['username' => 'user2']);
        $user->displayname = 'User2';
        $user->email = 'user2@pam.ru';
        $user->password = bcrypt(config('seeding.userpasswords.user2'));
        $userrole = Role::where('name','=','Специалист учреждения')->first();
        $user->role()->associate($userrole);
        $user->save();

        $user = User::firstOrNew(['username' => 'user3']);
        $user->displayname = 'User3';
        $user->email = 'user3@pam.ru';
        $user->password = bcrypt(config('seeding.userpasswords.user3'));
        $userrole = Role::where('name','=','Админастратор учреждения')->first();
        $user->role()->associate($userrole);
        $user->save();
    }
}
