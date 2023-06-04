<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Ar24api extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Ar24api';
    }
}