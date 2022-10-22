<?php

namespace App\Http\Facades;

class PriceCalculator
{
    /**
     * Calculate Total Price Without Discounts
     * @param $price
     * @param $count
     * @return float|int
     */
    public function calculateTotalPriceWithoutDiscounts($price, $count): float|int
    {
        return ($price * $count);
    }

    /**
     * Calculate Discount Price
     * @param $price
     * @param $count
     * @param $discountPercent
     * @return float|int
     */
    public function calculateDiscountPrice($price, $count, $discountPercent = null): float|int
    {
        $discountPrice = 0;

        if($discountPercent) {
            $discountPrice = $price * $count * ($discountPercent / 100);
        }

        return $discountPrice;
    }

    /**
     * Calculate Total Price
     * @param $price
     * @param $count
     * @param $discountPercent
     * @return float|int
     */
    public function calculateTotalPrice($price, $count, $discountPercent = null): float|int
    {
        $totalPriceWithoutDiscounts = $this->calculateTotalPriceWithoutDiscounts($price, $count);
        $discountPrice = $this->calculateDiscountPrice($price, $count, $discountPercent);

        return ($totalPriceWithoutDiscounts - $discountPrice);
    }
}