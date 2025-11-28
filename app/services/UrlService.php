<?php

namespace App\Services;

use App\Models\ShortUrl;
use Carbon\Carbon;

class UrlService
{
    public function create(array $data): ShortUrl
    {
        $payload = [
            'original_url' => $data['original_url'],
        ];

        if (!empty($data['code'])) {
            $payload['code'] = $data['code'];
        }

        if (!empty($data['expires_in_days'])) {
            $payload['expires_at'] = Carbon::now()->addDays((int)$data['expires_in_days']);
        }

        return ShortUrl::create($payload);
    }

    public function findByCode(string $code): ?ShortUrl
    {
        return ShortUrl::where('code', $code)->first();
    }

    public function incrementHits(ShortUrl $shortUrl): void
    {
        $shortUrl->increment('hits');
    }

    public function list(int $perPage = 20)
    {
        return ShortUrl::orderBy('created_at', 'desc')->paginate($perPage);
    }
}