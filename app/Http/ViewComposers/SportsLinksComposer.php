<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Sport;

class SportsLinksComposer
{
    public function compose(View $view)
    {
        // استعلام للبيانات التي تريد إتاحتها
        $sports_links = Sport::all();

        // تمرير البيانات إلى العرض
        $view->with('sports_links', $sports_links);
    }
}