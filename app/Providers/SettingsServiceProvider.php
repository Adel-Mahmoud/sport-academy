<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use App\Domains\Settings\Repositories\SettingRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot(SettingRepository $repository)
    {
        /*
        $settings = cache()->rememberForever('settings', function () use ($repository) {
            return $repository->all()->first()?->toArray() ?? [];
        });

        Config::set('settings', $settings); 
        */

        // Config::set('settings', $repository->all()->first()?->toArray() ?? []);

        try {
            if (!Schema::hasTable('settings')) {
                return;
            }

            Config::set('settings', $repository->all()->first()?->toArray() ?? []);

        } catch (QueryException $e) {
            return;
        }
    }
}
