<?php

namespace App\Services;

use App\Enums\CacheKeys;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Closure;

class CacheService
{
    public static function remember(CacheKeys $key, Closure $callback)
    {
        $ttl = Config::get("cache_ttl.{$key->value}", 3600);

        return Cache::remember($key->value, $ttl, $callback);
    }

    public static function forget(CacheKeys $key): void
    {
        Cache::forget($key->value);
    }
}
