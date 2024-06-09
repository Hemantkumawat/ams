<?php

use App\Settings\GeneralSettings;

if (!function_exists('getSetting')) {
    function getSetting(string $key, string $group = 'general', mixed $default = null)
    {
        return match ($group) {
            'general' => app(GeneralSettings::class)->$key ?? $default,
            default => null,
        };
    }
}
