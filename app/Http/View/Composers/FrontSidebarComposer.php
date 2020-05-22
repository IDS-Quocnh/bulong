<?php

namespace App\Http\View\Composers;

use App\Tag;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Bulong\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class FrontSidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // $tags = Tag::popularTags()->take(5);
        $tags = Tag::take(5)->get();

        if (auth()->user()) {
            $followingsCount = auth()->user()->followings()->count();
            $followersCount = auth()->user()->followers()->count();
        } else {
            $followersCount = '';
            $followingsCount = '';
        }

        $view
        ->with('followersCount', $followersCount)
        ->with('followingsCount', $followingsCount)
        ->with('tags', $tags);
    }
}
