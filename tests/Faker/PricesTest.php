<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Liior\Faker\Prices;
use Faker\Factory;


class PricesTest extends TestCase
{
    /** @var Prices */
    private $prices;

    public function setUp() : void
    {
        $this->prices = new Prices(Factory::create());
        $this->min = mt_rand(0, 100);
        $this->max = $this->min + mt_rand(50, 15000);
    }

    public function testDefaultRandomPrice()
    {
        $result = $this->prices->price();
        $decimals = "0." . substr($result, -2);
        $lastInteger = (int)substr(floor($result), -1);

        $this->assertTrue(is_float($result), "Default price should be a float");
        $this->assertTrue(in_array($decimals, Prices::DECIMALS), "Decimals of $result should be the same as one of Price::DECIMALS");
        $this->assertTrue($lastInteger === 9, "Last integer of $result should be a 9 !");
    }

    public function testDefaultRandomePriceWithValues()
    {
        $result = $this->prices->price($this->min, $this->max);

        $this->assertLessThanOrEqual($this->max, $result, "The random price $result should be lesser than or equal to $this->max");
        $this->assertGreaterThanOrEqual($this->min, $result, "The random price $result should be greater than or equal to $this->min");
    }

    public function testRandomPriceWithoutPsychologicalWithoutDecimals()
    {
        $result = $this->prices->price(10, 400, true, false, false);

        $this->assertTrue(ctype_digit((string)$result), "Random price $result should be an int !");
    }

    public function testRandomPriceWithoutPsychologicalButDecimals()
    {
        $result = $this->prices->price(10, 400, true, false, true);

        $this->assertTrue(is_float($result), "Random price $result should be a float !");
    }
}