<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsrfController extends Controller
{
    public function getToken()
    {
        $csrfToken = csrf_token();

        return response()->json(['csrfToken' => $csrfToken]);
    }
}
