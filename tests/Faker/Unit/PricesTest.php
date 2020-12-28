<?php

use Faker\Factory;
use Liior\Faker\Prices;


beforeEach(function () {
    $this->prices = new Prices(Factory::create());
    $this->min = mt_rand(0, 100);
    $this->max = $this->min + mt_rand(50, 15000);
});


it("should give a random price with 2 decimals and finish with a 9", function () {
    $result = $this->prices->price();
    $decimals = "0." . substr($result, -2);
    $lastInteger = (int)substr(floor($result), -1);

    expect($result)->toBeFloat()
        ->and(in_array($decimals, Prices::DECIMALS))->toBeTrue()
        ->and($lastInteger)->toBe(9);
});

it("should give a random number between min and max", function () {
    $result = $this->prices->price($this->min, $this->max);

    expect($result)->toBeLessThanOrEqual($this->max)
        ->toBeGreaterThanOrEqual($this->min);
});

it("should give a random price without decimals", function () {
    $result = $this->prices->price(10, 400, true, false, false);

    expect($result)->toBeInt();
});

it("shoud vie a random price with decimals", function () {
    $result = $this->prices->price(10, 400, true, false, true);

    expect($result)->toBeFloat();
});
