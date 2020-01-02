<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

if (! function_exists('add_active')) {
    function add_active(string ...$patterns)
    {
        return Route::currentRouteNamed(...$patterns) ? 'active' : '';
    }
}

if (! function_exists('color_contrast')) {
    function color_contrast(string $hex)
    {
        $r = hexdec(substr($hex, 1, 2));
        $g = hexdec(substr($hex, 3, 2));
        $b = hexdec(substr($hex, 5, 2));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? 'black' : 'white';
    }
}

if (! function_exists('format_date')) {
    function format_date(Carbon $date, bool $fullTime = false)
    {
        return $date->translatedFormat(trans('messages.date'.($fullTime ? '-full' : '')));
    }
}

if (! function_exists('asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function asset(string $path, $secure = null)
    {
        return app('url')->asset('assets/'.$path, $secure);
    }
}

if (! function_exists('format_date_compact')) {
    function format_date_compact(Carbon $date)
    {
        return $date->format(trans('messages.date-compact'));
    }
}

if (! function_exists('setting')) {
    function setting(string $name, $default = null)
    {
        return config('setting.'.$name, $default);
    }
}

if (! function_exists('favicon')) {
    function favicon()
    {
        $icon = setting('icon');
        return $icon !== null ? image_url($icon) : asset('img/azuriom.png');
    }
}

if (! function_exists('site_name')) {
    function site_name()
    {
        return setting('name', config('app.name'));
    }
}

if (! function_exists('money_name')) {
    function money_name($money = 2)
    {
        $moneyName = setting('money', 'points');
        return trans()->getSelector()->choose($moneyName, $money, trans()->getLocale());
    }
}

if (! function_exists('format_money')) {
    function format_money(float $money)
    {
        return $money.' '.money_name($money);
    }
}

if (! function_exists('image_url')) {
    function image_url(string $name = '/')
    {
        return url(Storage::url('img/'.$name));
    }
}

if (! function_exists('plugin_path')) {
    function plugin_path($path = '')
    {
        return base_path('plugins/'.$path);
    }
}

if (! function_exists('theme_path')) {
    function theme_path($path = '')
    {
        return resource_path('themes/'.$path);
    }
}

if (! function_exists('theme_config')) {
    function theme_config(string $name, $default = null)
    {
        return config('theme.'.$name, $default);
    }
}

if (! function_exists('theme_trans')) {
    function theme_trans(string $key, array $replace = [], $locale = null)
    {
        $theme = setting('theme');
        return trans("theme.{$theme}::{$key}", $replace, $locale);
    }
}

if (! function_exists('game')) {
    /**
     * Get the current game bridge implementation.
     *
     * @return \Azuriom\Game\GameBridge
     */
    function game()
    {
        return app('game');
    }
}

if (! function_exists('extensions')) {
    /**
     * Get the extensions manager.
     *
     * @return \Azuriom\Extensions\ExtensionsManager
     */
    function extensions()
    {
        return app('extensions');
    }
}
