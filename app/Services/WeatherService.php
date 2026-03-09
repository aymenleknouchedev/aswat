<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

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
        
        // If no city provided, try to detect from user's IP
        if (!$city) {
            $city = $this->detectCityFromIP();
        }
        
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

    /**
     * Get weather for multiple Algerian cities.
     * Returns array of weather data for each city.
     * 
     * @param array|null $cities Array of city names, defaults to major Algerian wilayas
     * @return array
     */
    public function getAlgerianCitiesWeather(?array $cities = null): array
    {
        if (!$cities) {
            // Default major Algerian wilayas + baladiyat from all regions
            $cities = [
                // Wilayas
                'Algiers,DZ',
                'Oran,DZ',
                'Constantine,DZ',
                'Annaba,DZ',
                'Setif,DZ',
                'Blida,DZ',
                'Batna,DZ',
                'Ghardaia,DZ',
                'Ouargla,DZ',
                'Tlemcen,DZ',
                'Tizi Ouzou,DZ',
                'Skikda,DZ',
                'Sidi Bel Abbes,DZ',
                'Tamanrasset,DZ',
                // Algiers Baladiyat
                'Bordj el Kiffan,DZ',
                'Cheraga,DZ',
                'Hussein Dey,DZ',
                'Bab el Oued,DZ',
                // Oran Baladiyat
                'Es Senia,DZ',
                'Misserghine,DZ',
                // Constantine Baladiyat
                'Ain Smara,DZ',
                'Ben Azouz,DZ',
                // Annaba Baladiyat
                'Sidi Amar,DZ',
                'El Bouni,DZ',
                // Blida Baladiyat
                'Bougara,DZ',
                'Mouzaia,DZ',
                // Setif Baladiyat
                'Ain Oulmene,DZ',
                'Beni Aziz,DZ',
                // Batna Baladiyat
                'Arris,DZ',
                'Barika,DZ',
                // Tizi Ouzou Baladiyat
                'Draâ Ben Khedda,DZ',
                'Azazga,DZ',
                // Skikda Baladiyat
                'Collo,DZ',
                'Taher,DZ',
            ];
        }

        $results = [];
        foreach ($cities as $city) {
            $weather = $this->current($city);
            if ($weather) {
                $results[$city] = $weather;
            }
        }

        return $results;
    }

    /**
     * Get Arabic name for an Algerian city.
     * 
     * @param string $englishName
     * @return string
     */
    public function getArabicCityName(string $englishName): string
    {
        $arabicCities = [
            // Algerian Wilayas (58)
            'Algiers' => 'الجزائر',
            'Aïn Defla' => 'عين الدفلى',
            'Aïn Témouchent' => 'عين تموشنت',
            'Adrar' => 'أدرار',
            'Annaba' => 'عنابة',
            'Batna' => 'باتنة',
            'Béchar' => 'البشار',
            'Béjaïa' => 'بجاية',
            'Biskra' => 'بسكرة',
            'Blida' => 'البليدة',
            'Boumerdès' => 'بومرداس',
            'Bouira' => 'البويرة',
            'Chlef' => 'الشلف',
            'Constanine' => 'قسنطينة',
            'Constantine' => 'قسنطينة',
            'Djanet' => 'جانت',
            'Djelfa' => 'الجلفة',
            'El Bayadh' => 'الباياض',
            'El Oued' => 'الوادي',
            'El Taref' => 'الطارف',
            'Ghardaia' => 'غرداية',
            'Guelma' => 'قالمة',
            'Illizi' => 'إليزي',
            'In Amenas' => 'إن أمناس',
            'In Guezzam' => 'إن قزام',
            'Jijel' => 'جيجل',
            'Khenchela' => 'خنشلة',
            'Laghouat' => 'الأغواط',
            'Mascara' => 'معسكر',
            'Medea' => 'المدية',
            'Mila' => 'ميلة',
            'Mostaganem' => 'مستغانم',
            'M\'Sila' => 'المسيلة',
            'MSila' => 'المسيلة',
            'Oran' => 'وهران',
            'Ouargla' => 'ورقلة',
            'Oum El Bouaghi' => 'أم البواقي',
            'Saida' => 'سعيدة',
            'Sétif' => 'سطيف',
            'Setif' => 'سطيف',
            'Sidi Bel Abbès' => 'سيدي بلعباس',
            'Sidi Bel Abbes' => 'سيدي بلعباس',
            'Souk Ahras' => 'سوق أهراس',
            'Tamanrasset' => 'تمنراست',
            'Tébessa' => 'تبسة',
            'Tiaret' => 'تيارت',
            'Tindouf' => 'تندوف',
            'Tipasa' => 'تيبازة',
            'Tlemcen' => 'تلمسان',
            'Tizi Ouzou' => 'تيزي وزو',
            'Tolga' => 'تولقة',
            'Tougourt' => 'توقرت',
            'Skikda' => 'سقيقدة',
            'Relizane' => 'الريليزاني',
            'Saïda' => 'سعيدة',
            
            // Algerian Baladiyat (Municipalities) - Algiers area and others
            'Bordj el Kiffan' => 'برج الكيفان',
            'Bordj Kiffan' => 'برج الكيفان',
            'Cheraga' => 'شراقة',
            'Dar el Beida' => 'دار البيضاء',
            'Dar El Beida' => 'دار البيضاء',
            'Beni Messous' => 'بني معسوس',
            'Kouba' => 'القوبة',
            'Sidi M\'Hamed' => 'سيدي محمد',
            'Sidi Mhamed' => 'سيدي محمد',
            'Baraki' => 'براقي',
            'Bachiraoui' => 'باشيراوي',
            'Belfort' => 'بلفور',
            'Bir Mourad Rais' => 'بئر مراد رايس',
            'Bab el Oued' => 'باب الواد',
            'Bab Oued' => 'باب الواد',
            'Hussein Dey' => 'حسين داي',
            'El Madania' => 'المادية',
            'Birkhadem' => 'بركهادم',
            'Hydra' => 'حيدرة',
            'Ben Aknoun' => 'بن عكنون',
            'Sidi Fredj' => 'سيدي فرج',
            'Zeralda' => 'زرالدة',
            'Ouled Fayet' => 'أولاد فايت',
            'Draria' => 'درارية',
            'Bab Ezzouar' => 'باب الزوار',
            'Bab Ez Zouar' => 'باب الزوار',
            'Rais Hamidou' => 'رايس حميدو',
            'Sidi Moussa' => 'سيدي موسى',
            'Ouled Chebel' => 'أولاد شبل',
            'Djamaa' => 'جمعة',
            'Bir El Djir' => 'بئر الجير',
            'Bir Eldjir' => 'بئر الجير',
            
            // Oran Wilaya Baladiyat
            'Es Senia' => 'السانية',
            'Sidi Cha\'m' => 'سيدي الشعم',
            'Bir El Djir' => 'بئر الجير',
            'Hammam Bouziane' => 'حمام بوزيان',
            'Tafraoui' => 'تفراوي',
            'Misserghine' => 'مسرغين',
            
            // Constantine Wilaya Baladiyat
            'Ain Smara' => 'عين الصمراء',
            'Ben Azouz' => 'بن عزوز',
            'Didouche Mourad' => 'ديدوش مراد',
            'Zighout Youcef' => 'زيغوت يوسف',
            'Ibn Badis' => 'ابن باديس',
            
            // Annaba Wilaya Baladiyat
            'Sidi Amar' => 'سيدي عمار',
            'El Bouni' => 'البوني',
            'Chetaibi' => 'الشطايبي',
            'Oued El Aneb' => 'وادي العنب',
            
            // Blida Wilaya Baladiyat
            'Bougara' => 'بوقرة',
            'Chebli' => 'شبلي',
            'Damous' => 'داموس',
            'Soumaa' => 'سوما',
            'Mouzaia' => 'موزاية',
            'Larbaa' => 'العريب',
            
            // Setif Wilaya Baladiyat
            'Ain Oulmene' => 'عين آولمن',
            'Beni Aziz' => 'بني عزيز',
            'Beni Ourtilane' => 'بني ورتيلان',
            'Guellal' => 'قلال',
            'Boutaleb' => 'بوتاليب',
            
            // Batna Wilaya Baladiyat
            'Arris' => 'آريس',
            'Barika' => 'بارقة',
            'Belezma' => 'بلزمة',
            'Oum El Bouaghi' => 'أم البواقي',
            'Tazoult' => 'تازولت',
            
            // Tlemcen Wilaya
            'Sidi Medel' => 'سيدي معدل',
            'Sabra' => 'صابرة',
            
            // Tizi Ouzou Wilaya Baladiyat
            'Draâ Ben Khedda' => 'درعة بن خديدة',
            'Mekla' => 'مكلة',
            'Azazga' => 'أزازقة',
            'Tirourda' => 'تيرورضا',
            
            // Skikda Wilaya Baladiyat
            'Collo' => 'القولة',
            'Taher' => 'طاهر',
            'Beni Oulbaz' => 'بني ولباز',
            
            // Ghardaia Wilaya Baladiyat
            'Melika' => 'مليكة',
            'Djanet' => 'جانت',
            'Metlili' => 'متليلي',
            
            // Ouargla Wilaya Baladiyat
            'Hassi Messaoud' => 'حاسي مسعود',
            'Touggourt' => 'توقرت',
            'Hassi Mouloud' => 'حاسي مولود',
        ];

        return $arabicCities[$englishName] ?? $englishName;
    }

    /**
     * Detect user's city from their IP address using free geolocation API.
     * Uses ipapi.co for reliable geolocation with Arabic city names support.
     * 
     * @return string|null
     */
    protected function detectCityFromIP(): ?string
    {
        try {
            // Get client IP address
            $clientIp = $this->getClientIP();
            
            // For localhost testing, use a public IP to test geolocation
            if (!$clientIp || $clientIp === '127.0.0.1' || $clientIp === '::1') {
                // Use a test IP from Cairo, Egypt for demo purposes
                if (config('app.debug')) {
                    $clientIp = '197.0.32.1'; // Test IP (Egypt)
                } else {
                    return null; // Production: skip geolocation for localhost
                }
            }

            // Cache geolocation for 24 hours per IP
            $cacheKey = sprintf('geolocation:%s', $clientIp);
            
            return Cache::remember($cacheKey, 86400, function () use ($clientIp) {
                // Using ipapi.co - free API with Arabic support
                $response = Http::timeout(5)->get("https://ipapi.co/{$clientIp}/json/");
                
                if (!$response->ok()) {
                    return null;
                }

                $data = $response->json();
                
                if (!is_array($data) || empty($data['city'])) {
                    return null;
                }

                $city = $data['city'] ?? null;
                $country = $data['country_code'] ?? null;
                
                if (!$city || !$country) {
                    return null;
                }

                // Return city with country code format
                return "{$city},{$country}";
            });
        } catch (\Throwable $e) {
            // Silently fail and use default city
            return null;
        }
    }

    /**
     * Get the client's IP address from the request.
     * 
     * @return string|null
     */
    protected function getClientIP(): ?string
    {
        // Check various headers in order of preference
        $headers = [
            'HTTP_CF_CONNECTING_IP',      // Cloudflare
            'HTTP_X_FORWARDED_FOR',       // Proxy
            'HTTP_X_FORWARDED',           // Proxy
            'HTTP_FORWARDED_FOR',         // Proxy
            'HTTP_FORWARDED',             // Proxy
            'HTTP_CLIENT_IP',             // Proxy
            'REMOTE_ADDR',                // Direct connection
        ];

        foreach ($headers as $header) {
            if (empty($_SERVER[$header])) {
                continue;
            }

            $ip = $_SERVER[$header];
            
            // If X-Forwarded-For, might contain multiple IPs
            if ($header === 'HTTP_X_FORWARDED_FOR') {
                $ips = explode(',', $ip);
                $ip = trim($ips[0]); // Take first IP
            }

            // Validate IP address
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }

        return null;
    }

    /**
     * Get weather with a simulated IP for testing/debugging.
     * 
     * @param string $testIp The IP to simulate (e.g., '197.0.32.1' for Egypt)
     * @return array|null
     */
    public function testWithIP(string $testIp): ?array
    {
        try {
            $cacheKey = sprintf('geolocation:%s', $testIp);
            
            $detectedCity = Cache::remember($cacheKey, 86400, function () use ($testIp) {
                $response = Http::timeout(5)->get("https://ipapi.co/{$testIp}/json/");
                
                if (!$response->ok()) {
                    return null;
                }

                $data = $response->json();
                
                if (!is_array($data) || empty($data['city'])) {
                    return null;
                }

                $city = $data['city'] ?? null;
                $country = $data['country_code'] ?? null;
                
                if (!$city || !$country) {
                    return null;
                }

                return "{$city},{$country}";
            });

            if ($detectedCity) {
                return $this->current($detectedCity);
            }
            
            return $this->current();
        } catch (\Throwable $e) {
            return $this->current();
        }
    }
}
