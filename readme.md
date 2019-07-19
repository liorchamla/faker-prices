# faker-prices

Providing typical and credible prices for [fzaninotto/faker](https://github.com/fzaninotto/faker) !

## Contents

1. [Installation](#installation)
1. [Basic Usage](#basic-usage)
1. [Details](#details)

## Installation

```bash
composer require liorchamla/faker-prices
```

## Basic Usage

You just have to add the Prices provider to Faker as any other provider :

```php
<?php
// Adding the provider to Faker
$faker = \Faker\Factory::create();
$faker->addProvider(new Liior\Faker\Prices($faker));

// Using the provider :
echo $faker->price(); // prints 49.99

```

## Details

You can use several parameters :

```php
// Function signature :
$faker->price($min = 1000, $max = 20000, $psychologicalPrice = true, $decimals = true)

// You can cancel the $psychologicalPrice (which gives you credible prices like 29.49 or 119.99 instead of random 23.49 or 102.49)
$faker->price(100, 200, false); // 113.49
$faker->price(100, 200, true); // 109.49

// You can cancel the $decimals also (decimals can be X.29, X.49 or X.99)
$faker->price(100, 200, true, false); // 109
$faker->price(100, 200, true, true); // 109.49
```
