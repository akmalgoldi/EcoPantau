<?php

namespace App\Http\Controllers;

// Pastikan Anda mengimpor ini:
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController; // Ubah ini

abstract class Controller extends BaseController // Ubah ini
{
    use AuthorizesRequests;
}
