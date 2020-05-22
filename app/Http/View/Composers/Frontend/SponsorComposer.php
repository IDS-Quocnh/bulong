<?php

namespace App\Http\View\Composers\Frontend;

use App\Setting;
use Spatie\Tags\Tag;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Bulong\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class SponsorComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tags = Tag::latest()->get();
        $sponsor = Setting::whereIn('key', ['sponsor_image', 'sponsor_url'])->get()->pluck('value');
        $sponsorImage = asset('storage/'. $sponsor[0]);
        $sponsorUrl = $sponsor[1];

        $view
        ->with('sponsorImage', $sponsorImage)
        ->with('sponsorUrl', $sponsorUrl);
    }
}
