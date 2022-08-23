<?php

namespace App\Controllers;

use App\Components\Terminal;
use App\Traits\ApiTrait;

class ProductController
{
    use ApiTrait;

    /**
     * @return void
     */
    public function index()
    {
        $terminal = new Terminal();

        if (!isset($_GET['id']))
        {
            $strErrorDesc = 'Bad Request';
            $this->sendOutput($strErrorDesc, 400);
        }

        $products = $terminal->scan(explode(';', $_GET['id']));

        $prices = $terminal->getPricing(array_keys($products));

        $total = $terminal->total($products, $prices);

        $this->sendOutput(json_encode($total), 200);
    }
}