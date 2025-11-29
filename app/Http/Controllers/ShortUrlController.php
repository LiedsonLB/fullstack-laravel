<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Http\Requests\StoreShortUrlRequest;
use App\Models\ShortUrl;
use App\Services\UrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShortUrlController extends Controller
{
    protected UrlService $service;

    public function __construct(UrlService $service)
    {
        $this->service = $service;
    }

    // POST /api/urls
    public function store(StoreShortUrlRequest $request)
    {
        Log::info('entra em store do ShortUrlController');

        $short = $this->service->create($request->validated());

        Log::info('Short URL created with ID: ' . $short->id);

        return response()->json([
            'id' => $short->id,
            'code' => $short->code,
            'short_url' => url('/' . $short->code),
            'original_url' => $short->original_url,
            'expires_at' => $short->expires_at,
            'hits' => $short->hits,
            'created_at' => $short->created_at,
        ], 201);
    }

    // GET /api/urls
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 20);
        $urls = $this->service->list($perPage);

        return response()->json($urls);
    }

    public function show($id)
    {
        $short = ShortUrl::findOrFail($id);
        return response()->json($short);
    }

    public function destroy($id)
    {
        $short = ShortUrl::findOrFail($id);
        $short->delete();
        return response()->json(null, 204);
    }
}