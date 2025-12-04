# Weather widget setup

The secondary navigation weather widget uses OpenWeather to show real temperatures for الجزائر.

1. Create an API key at https://openweathermap.org/api
2. Add the following to your `.env` file:

```
WEATHER_API_KEY=your_api_key_here
# Optional overrides
WEATHER_CITY=Algiers,DZ
WEATHER_TTL=600
WEATHER_UNITS=metric
WEATHER_LANG=ar
```

Notes:
- Data is cached for 10 minutes by default.
- Day shows today's max temperature; Night shows today's min (from the current weather response `temp_max`/`temp_min`).
- If the API key is missing or a request fails, the widget falls back to static values.
