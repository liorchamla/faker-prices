<?php

use Faker\Factory;
use Liior\Faker\Prices;

it("should work well with faker addProvider method", function () {
    $faker = Factory::create();
    $faker->addProvider(new Prices($faker));

    $result = $faker->price();
    $decimals = "0." . substr($result, -2);
    $lastInteger = (int)substr(floor($result), -1);

    expect($result)->toBeFloat()
        ->and(in_array($decimals, Prices::DECIMALS))->toBeTrue()
        ->and($lastInteger)->toBe(9);
});
