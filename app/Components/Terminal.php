<?php

namespace App\Components;

use App\DB;
use App\Interfaces\SellerInterface;
use PDO;

class Terminal implements SellerInterface
{
    /**
     * @param  array  $products
     *
     * @return array
     */
    public function getPricing(array $products)
    {
        $db = DB::getConection();

        $products = implode(',', $products);
        $result = $db->query("
            SELECT
                products.id,
                products.title,
                product_pricing.base_price,
                product_discount.discounted_value,
                product_discount.products_count
            FROM products
            JOIN product_pricing
                ON products.id = product_pricing.product_id
            LEFT JOIN product_discount
                 ON products.id = product_discount.product_id
            WHERE products.id IN ($products);
        ");

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $value) {
            $pricing[$value['id']] = $value;
        }

        return $pricing;
    }

    /**
     * @param  array  $products
     *
     * @return array
     */
    public function scan(array $products)
    {
        return array_count_values($products);
    }

    /**
     * @param $products
     * @param $pricing
     *
     * @return array
     */
    public function total($products, $pricing)
    {
        $result = [];
        $total = 0;

        foreach ($products as $product => $count) {

            if (is_null($pricing[$product]['products_count'])) {
                $price = $pricing[$product]['base_price'] * $count;
            } else {
                $price = ((int) ($count / $pricing[$product]['products_count']) * $pricing[$product]['discounted_value']) + ($count % $pricing[$product]['products_count']) * $pricing[$product]['base_price'];
            }

            $result[] = [
                'id'    => $product,
                'title' => $pricing[$product]['title'],
                'count' => $count,
                'price' => $price,
            ];

            $total += $price;
        }

        $result['total'] = $total;

        return $result;
    }
}