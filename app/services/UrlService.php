<?php

namespace App\Services;

use App\Models\ShortUrl;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UrlService
{
    public function create(array $data): ShortUrl
    {
        Log::info('UrlService: Iniciando.', ['data' => $data]);

        try {
            $payload = [
                'original_url' => $data['original_url'],
                'hits' => 0,
            ];

            if (!empty($data['code'])) {
                $payload['code'] = $data['code'];
            } else {
                $payload['code'] = ShortUrl::generateUniqueCode();
            }

            if (!empty($data['expires_in_days'])) {
                $payload['expires_at'] = Carbon::now()->addDays((int)$data['expires_in_days']);
            }

            $shortUrl = ShortUrl::create($payload);

            Log::info('UrlService: crisco.', ['id' => $shortUrl->id]);
            return $shortUrl;
        } catch (\Throwable $e) {
            Log::error('error.', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
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
