<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MapController extends Controller
{
    /**
     *
     * @return View
     */
    public function index(): View
    {
        $accessToken = config('services.mapbox.token');

        return view('map.index', compact('accessToken'));
    }
}
