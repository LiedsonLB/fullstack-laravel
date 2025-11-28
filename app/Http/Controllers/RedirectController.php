<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Services\UrlService;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    protected UrlService $service;

    public function __construct(UrlService $service)
    {
        $this->service = $service;
    }

    public function redirect($code, Request $request)
    {
        $short = $this->service->findByCode($code);

        if (!$short) {
            return response()->view('errors.404', [], 404);
        }

        if ($short->isExpired()) {
            return response()->view('errors.410', ['message' => 'Link expirado'], 410);
        }

        $this->service->incrementHits($short);

        return redirect()->away($short->original_url, 302);
    }
}