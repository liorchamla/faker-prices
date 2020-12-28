<?php

namespace Liior\Faker;

use Faker\Provider\Base;

/**
 * Faker provider for credible and typical prices
 * 
 * @package FakerPrices
 * @author Lior Chamla <lchamla@gmail.com>
 */
class Prices extends Base
{
    const DECIMALS = [0.29, 0.49, 0.99];

    /**
     * Returns a rounded number to his nearest tenth
     * Exemple : 12.33 => 10
     * Exemple : 16.21 => 20
     *
     * @param float $number
     * @return integer
     */
    protected function getNearestTenth(float $number): int
    {
        return round($number, -1);
    }

    /**
     * Returns typical pricing decimals by fetching it in Prices::DECIMALS
     *
     * @return float
     */
    protected function getDecimals(): float
    {
        return $this->generator->randomElement(self::DECIMALS);
    }

    /**
     * Provides a natural looking price between $min and $max.
     * It will also round it to the nearest tenth and substract 1 to give it a psychological impact.
     * Then it will add pricing typical decimals (X.29 or X.99)
     *
     * @param integer $min
     * @param integer $max
     * @param boolean $tenths
     * @param boolean $psychologicalPrice
     * @param boolean $decimals
     * @return float|int
     */
    public function price($min = 1000, $max = 20000, $tenths = true, $psychologicalPrice = true, $decimals = true)
    {
        if ($decimals) {
            $price = $this->generator->randomFloat(2, $min, $max);
        } else {
            $price = $this->generator->numberBetween($min, $max);
        }

        if ($tenths) {
            $price = $this->getNearestTenth($price);
            if ($psychologicalPrice) {
                $price = $price - 1;
            }
        }

        if ($decimals) {
            $price += $this->getDecimals();
        }

        return $price;
    }
}
