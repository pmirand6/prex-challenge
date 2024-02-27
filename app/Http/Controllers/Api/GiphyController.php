<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class GiphyController extends Controller
{
    public function __construct(private readonly GiphyService $giphyService)
    {
    }
}
