<?php

namespace App\Providers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        $sports_links = DB::table('sports')->get();
        view()->share('sports_links', $sports_links);
        $jobs_links = DB::table('jobs')->get();
        view()->share('jobs_links', $jobs_links);
        $teams_links = DB::table('teams')->get();
        view()->share('teams_links', $teams_links);
        $settings = DB::table('settings')->pluck('option_value', 'option_key');
        view()->share('settings', $settings);
        
        $currentYear = date('Y');
        $currentMonth = date('m');
        $salariesQuery = DB::table('salaries')->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)->get();
        $ratio1 = 0;
        $ratio2 = 0;
        $ratio3 = 0;
        foreach ($salariesQuery as $sq) {
            if ($sq->ratio === 1) { // Access the ratio property using `->`
                $ratio1 += $sq->salary; // Use += to accumulate the sum
            } else if ($sq->ratio === 2) {
                $ratio2 += $sq->salary;
            } else {
                $ratio3 += $sq->salary;
            }
        }
        $ratio = $ratio1 + $ratio2 + $ratio3; // Calculate the total ratio
        view()->share('ratio', $ratio);
        view()->share('ratio1', $ratio1);
        view()->share('ratio2', $ratio2);
        view()->share('ratio3', $ratio3);
    }
}
