<?php
namespace Curder\LandingPages\Http\Controllers;

use App\Http\Controllers\Controller;
use Curder\LandingPages\Models\LandingPage;

class LandingPagesController extends Controller
{
    /**
     * @param string  $slug
     * @param array $args
     *
     * @return mixed
     */
    public function show($slug, ...$args)
    {
        $prefix      = config('landing-page.prefix') ?? 'pages';
        $default     = config('landing-page.whoops') ?? 'whoops';
        $args = collect($args)->map(function ($item) use ($args) {
            return count($args) ? '.' . $item : '';
        })->implode('');

        $combine     = $prefix.'.'.$slug;
        $whoops_page = empty($args) ? pathinfo($combine, PATHINFO_FILENAME) . '.' . $default : $combine . pathinfo($args, PATHINFO_FILENAME) . '.' . $default;
        $page        = $combine . $args;


        if (view()->exists($page)) {
            return view($page);
        }

        $path = $this->getUri();
        if ($this->exists($path)) {
            /** @var LandingPage $page */
            $page = $this->getPageBy($path);
            return view($page->template_path, $page);
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
     * @param string $slug The slug to search for in the database.
     * @return bool Returns true if the page exists, false otherwise.
     **/
    public function exists($slug)
    {
        return !! LandingPage::where('slug', $slug)->count();
    }

    /**
     * Gets all the data of the page from the database, based on the slug.
     *
     * @param string $slug The slug to search for in the database.
     * @param bool $trashed Include trashed (soft deleted) pages?
     * @return array The data such as title, content and publishing date in an array.
     **/
    public function getPageBy($slug, $trashed = false)
    {
        if ($trashed) {
            return LandingPage::withTrashed()->where('slug', $slug)->first();
        }
        return LandingPage::where('slug', $slug)->first();
    }
}
