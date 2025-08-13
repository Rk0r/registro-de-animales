<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
    public function checkDBConnection()
{
    try {
        \DB::connection()->getPdo();
        return true;
    } catch (\Exception $e) {
        return false;
    }
}
}
