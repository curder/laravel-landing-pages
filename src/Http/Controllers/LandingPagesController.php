<?php
namespace Curder\LandingPages\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Builder;
use Curder\LandingPages\Models\LandingPage;

/**
 * Class LandingPagesController
 *
 * @package Curder\LandingPages\Http\Controllers
 */
class LandingPagesController extends Controller
{
    /**
     * @param  string  $slug
     * @param  array  $args
     *
     * @return mixed
     */
    public function show(string $slug, ...$args)
    {
        $prefix      = config('landing-pages.prefix') ?? 'pages';
        $default     = config('landing-pages.whoops') ?? 'whoops';
        $string      = collect($args)->map(function ($item) use ($args) {
            return count($args) ? '.'.$item : '';
        })->implode('');
        $combine     = $prefix.'.'.$slug;
        $whoops_page = empty($string) ? pathinfo($combine, PATHINFO_FILENAME).'.'.$default : $combine.pathinfo($string,
                PATHINFO_FILENAME).'.'.$default;
        $pageUri        = rtrim(rtrim($combine.$string, config('landing-pages.url_html_suffix')), '.'); // 定位页面，如果存在后缀需要去除

        $uri = $this->getUri();

        // 自定义视图
        if (view()->exists($pageUri)) {
            $pageModel = new LandingPage;
            if (method_exists($this, 'tryExists') && method_exists($this, 'tryGetPageBy')) {
                // 尝试数据库数据
                $pageModel = $this->tryExists($uri) ? $this->tryGetPageBy($uri) : new LandingPage;
            }

            return view($pageUri)->with('page', $pageModel);
        }

        // 从数据库获取数据
        if ($this->exists($uri)) {
            /** @var LandingPage $page */
            $page     = $this->getPageBy($uri);
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
    protected function getUri() : string
    {
        return optional(request())->path();
    }
    /**
     * Checks if a page exists in the database.
     *
     * @param  string  $uri  the uri to search for in the database
     *
     * @return bool returns true if the page exists, false otherwise
     **/
    public function exists(string $uri) : bool
    {
        return (bool) LandingPage::where('uri', $uri)->count();
    }
    /**
     * Gets all the data of the page from the database, based on the uri.
     *
     * @param  string  $uri  the uri to search for in the database
     * @param  bool  $trashed  Include trashed (soft deleted) pages?
     *
     * @return array|LandingPage|Builder
     **/
    public function getPageBy(string $uri, $trashed = false)
    {
        if ($trashed) {
            return LandingPage::withTrashed()->where('uri', $uri)->first();
        }

        return LandingPage::where('uri', $uri)->first();
    }
}
