<?php

use App\Models\User;
use App\Models\Role;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => str_random(10),
        'displayname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(User::class, 'appadmin', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);
    return array_merge($user,
    	[
    		'role_id' => Role::getAppAdminRole()->id,
    		'allow_individual' => 0,
    	]);
});

$factory->defineAs(User::class, 'depadmin', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);
    return array_merge($user,
    	[
    		'role_id' => Role::getDepAdminRole()->id,
    		'allow_individual' => 0,
    	]);
});

$factory->defineAs(User::class, 'instadmin', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);
    return array_merge($user,
    	[
    		'role_id' => Role::getInstAdminRole()->id,
    		'allow_individual' => 0,
    	]);
});

$factory->defineAs(User::class, 'instspec', function ($faker) use ($factory) {
    $user = $factory->raw(User::class);
    return array_merge($user,
    	[
    		'role_id' => Role::getInstSpecRole()->id,
    		'allow_individual' => 0,
    	]);
});