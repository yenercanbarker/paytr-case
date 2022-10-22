<?php

namespace App\Http\Facades\FacadeClasses;

use Illuminate\Support\Facades\Facade;

class PriceCalculator extends Facade
{
    protected static function getFacadeAccessor() { return 'PriceCalculator'; }
}