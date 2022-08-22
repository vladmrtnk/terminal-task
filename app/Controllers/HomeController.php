<?php

namespace App\Controllers;

use App\DB;

class HomeController
{
    /**
     * @return void
     */
    public function index()
    {
        require_once APP_ROOT . '/views/home/index.php';
    }
}