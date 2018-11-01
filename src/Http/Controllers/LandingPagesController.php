<?php

namespace Curder\LandingPages\Http\Controllers;

use App\Http\Controllers\Controller;
use Curder\LandingPages\Models\LandingPage;

class LandingPagesController extends Controller
{
    /**
     * @param string $slug
     * @param array  $args
     *
     * @return mixed
     */
    public function show($slug, ...$args)
    {
        $prefix = config('landing-pages.prefix') ?? 'pages';
        $default = config('landing-pages.whoops') ?? 'whoops';
        $args = collect($args)->map(function ($item) use ($args) {
            return count($args) ? '.'.$item : '';
        })->implode('');

        $combine = $prefix.'.'.$slug;
        $whoops_page = empty($args) ? pathinfo($combine, PATHINFO_FILENAME).'.'.$default : $combine.pathinfo($args, PATHINFO_FILENAME).'.'.$default;
        $page = $combine.$args;

        if (view()->exists($page)) {
            return view($page);
        }

        $uri = $this->getUri();
        if ($this->exists($uri)) {
            /** @var LandingPage $page */
            $page = $this->getPageBy($uri);
            $template = view()->exists($page->template) ? $page->template : config('landing-pages.database.default_template');

            return view($template, compact('page'));
        }

        if (view()->exists($whoops_page)) {
            return view($whoops_page);
        }
        abort(404);
    }

    /**
     * @return string
     */
    protected function getUri()
    {
        return request()->path();
    }

    /**
     * Checks if a page exists in the database.
     *
     * @param string $uri the uri to search for in the database
     *
     * @return bool returns true if the page exists, false otherwise
     **/
    public function exists($uri)
    {
        return (bool) LandingPage::where('uri', $uri)->count();
    }

    /**
     * Gets all the data of the page from the database, based on the uri.
     *
     * @param string $uri     the uri to search for in the database
     * @param bool   $trashed Include trashed (soft deleted) pages?
     *
     * @return array the data such as title, content and publishing date in an array
     **/
    public function getPageBy($uri, $trashed = false)
    {
        if ($trashed) {
            return LandingPage::withTrashed()->where('uri', $uri)->first();
        }

        return LandingPage::where('uri', $uri)->first();
    }
}
