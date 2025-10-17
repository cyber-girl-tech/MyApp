<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController; // <-- This is the crucial part

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}