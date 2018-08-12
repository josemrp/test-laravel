<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Tag;

class AsideComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tags = Tag::all();
        $view->with('tags', $tags);
    }
}