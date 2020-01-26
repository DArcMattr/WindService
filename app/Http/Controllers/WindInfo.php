<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WindInfo extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  string $zipCode
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $zipCode)
    {
        return response()->json([
            'speed' => $zipCode,
            'direction' => '',
        ]);
    }
}
