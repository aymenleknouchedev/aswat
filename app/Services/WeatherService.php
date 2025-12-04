<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    /**
     * Get current weather for a given city (default from config) and cache it.
     * Returns associative array or null on failure.
     *
     * @param string|null $city
     * @return array|null
     */
    public function current(?string $city = null): ?array
    {
        $apiKey = Config::get('services.openweather.key');
        $city = $city ?: Config::get('services.openweather.city', 'Algiers,DZ');
        $units = Config::get('services.openweather.units', 'metric');
        $lang = Config::get('services.openweather.lang', 'ar');
        $ttl = (int) Config::get('services.openweather.ttl', 600);

        // Use different cache keys per provider
        $cacheKey = sprintf('weather:%s:%s:%s', empty($apiKey) ? 'open-meteo' : 'openweather', strtolower($city), $units);

        return Cache::remember($cacheKey, $ttl, function () use ($apiKey, $city, $units, $lang) {
            try {
                if (empty($apiKey)) {
                    // Fallback provider: Open-Meteo (no API key required)
                    return $this->fetchFromOpenMeteo($city, $units);
                }

                // Primary provider: OpenWeather
                $response = Http::timeout(6)
                    ->get('https://api.openweathermap.org/data/2.5/weather', [
                        'q' => $city,
                        'appid' => $apiKey,
                        'units' => $units,
                        'lang' => $lang,
                    ]);

                if (!$response->ok()) {
                    return null;
                }

                $data = $response->json();
                if (!is_array($data)) {
                    return null;
                }

                $name = $data['name'] ?? 'الجزائر';
                $sysCountry = $data['sys']['country'] ?? 'DZ';
                $temp = $data['main']['temp'] ?? null;
                $tmin = $data['main']['temp_min'] ?? null;
                $tmax = $data['main']['temp_max'] ?? null;
                $weather = $data['weather'][0] ?? [];
                $icon = $weather['icon'] ?? null; // e.g., 01d
                $desc = $weather['description'] ?? null;

                // Normalize to integers for display
                $normalize = function ($v) {
                    return $v !== null ? (int) round($v) : null;
                };

                return [
                    'city' => $name,
                    'country' => $sysCountry,
                    'temp' => $normalize($temp),
                    'day' => $normalize($tmax),
                    'night' => $normalize($tmin),
                    'icon' => $icon,
                    'desc' => $desc,
                    'units' => $units,
                ];
            } catch (\Throwable $e) {
                return null;
            }
        });
    }

    /**
     * Fetch weather using Open-Meteo (no API key required).
     * Uses configured lat/lon and timezone; city label comes from config city.
     */
    protected function fetchFromOpenMeteo(string $city, string $units): ?array
    {
        $lat = (float) Config::get('services.openweather.lat', 36.7538);
        $lon = (float) Config::get('services.openweather.lon', 3.0588);
        $tz  = Config::get('services.openweather.tz', 'Africa/Algiers');

        // Map units
        $tempUnit = $units === 'imperial' ? 'fahrenheit' : 'celsius';

        $query = [
            'latitude' => $lat,
            'longitude' => $lon,
            'current' => 'temperature_2m,weather_code',
            'daily' => 'temperature_2m_max,temperature_2m_min',
            'timezone' => $tz,
            'forecast_days' => 1,
            'temperature_unit' => $tempUnit,
        ];

        $response = Http::timeout(6)->get('https://api.open-meteo.com/v1/forecast', $query);
        if (!$response->ok()) {
            return null;
        }

        $data = $response->json();
        if (!is_array($data)) {
            return null;
        }

        $current = $data['current'] ?? [];
        $daily = $data['daily'] ?? [];
        $temp = $current['temperature_2m'] ?? null;
        $tmax = $daily['temperature_2m_max'][0] ?? null;
        $tmin = $daily['temperature_2m_min'][0] ?? null;

        $normalize = function ($v) {
            return $v !== null ? (int) round($v) : null;
        };

        return [
            'city' => $city,
            'country' => 'DZ',
            'temp' => $normalize($temp),
            'day' => $normalize($tmax),
            'night' => $normalize($tmin),
            'icon' => null,
            'desc' => null,
            'units' => $units,
        ];
    }
}
