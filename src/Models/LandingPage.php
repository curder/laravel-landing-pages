<?php

namespace Curder\LandingPages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LandingPage.
 *
 * @property string template_path
 */
class LandingPage extends Model
{
    use SoftDeletes;

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('landing-pages.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('landing-pages.database.landing_pages_table'));

        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function selectTemplatePathOptions()
    {
        return config('landing-pages.database.templates');
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function defaultTemplatePath()
    {
        return config('landing-pages.database.default_template');
    }
}
