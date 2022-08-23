<?php

namespace App\Interfaces;

interface SellerInterface
{
    /**
     * @param  mixed $product
     *
     * @return mixed
     */
    public function getPricing(array $products);

    /**
     * @param  array  $products
     *
     * @return mixed
     */
    public function scan(array $products);

    /**
     * @param $products
     * @param $pricing
     *
     * @return mixed
     */
    public function total($products, $pricing);
}