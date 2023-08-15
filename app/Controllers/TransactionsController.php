<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\View;

class TransactionsController
{
    public function index(): View
    {
        return View::make('transactions');
    }
}