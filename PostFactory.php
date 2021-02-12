<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model;
use Faker\Generator as Faker;
use App\User; //追記
$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'team_name'   => $faker->realText(100),
        'team_desc' => $faker->realText(100),
        'user_id' => function() {
            return User::all()->random();
        }
    ];
});