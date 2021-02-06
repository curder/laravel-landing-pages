<?php
namespace Curder\LandingPages\Tests\Future;

use Curder\LandingPages\Tests\TestCase;
use Illuminate\Support\Facades\Schema;

/**
 * Class LandingPageModelTest
 *
 * @package \Curder\LandingPages\Tests\Future
 */
class LandingPageModelTest extends TestCase
{
    /** @test */
    public function it_has_landing_pages_table(): void
    {
        self::assertTrue(Schema::hasTable(config('landing-pages.database.landing_pages_table')));
    }

    /** @test */
    public function landing_pages_database_has_expected_columns(): void
    {
        self::assertTrue(Schema::hasColumns(config('landing-pages.database.landing_pages_table'), [
            'id', 'title', 'body', 'uri', 'template', 'deleted_at',
        ]));
    }
}
