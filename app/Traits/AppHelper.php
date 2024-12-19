<?php

namespace App\Traits;

trait AppHelper
{
    public static function perUser($permission){
        return (auth()->check()) ? auth()->user()->can($permission):false;
    }
}
