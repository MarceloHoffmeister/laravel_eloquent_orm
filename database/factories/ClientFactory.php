<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use App\Models\ClientProfile;
use Faker\Generator as Faker;

require_once 'database/faker_data/document_number.php';

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phonenumber,
        'defaulter' => rand(0,1),
        //'soccer_team_id' => rand(1, SoccerTeamsTableSeeder::MAX_ROWS)
    ];
});

$factory->state(Client::class, Client::TYPE_INDIVIDUAL, function(Faker $faker) {
    $cpfs = cpfs();
    return [
        'date_birth' => $faker->date(),
        'document_number' => $cpfs[array_rand($cpfs, 1)],
        'sex' => rand(1,10) % 2 == 0 ? 'm' : 'f',
        'marital_status' => rand(1,3),
        'physical_disability' => rand(1,10) % 2 == 0 ? $faker->word : null,
        'client_type' => Client::TYPE_INDIVIDUAL
    ];
});

$factory->state(Client::class, Client::TYPE_LEGAL, function(Faker $faker) {
    $cnpjs = cnpjs();
    return [
        'document_number' => $cnpjs[array_rand($cnpjs, 1)],
        'company_name' => $faker->company,
        'client_type' => Client::TYPE_LEGAL
    ];
});

$factory->define(ClientProfile::class, function (Faker $faker) {
    return [
        'field' => $faker->name
    ];
});
