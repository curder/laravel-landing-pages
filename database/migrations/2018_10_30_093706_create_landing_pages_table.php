<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $connection = config('landing-pages.database.connection') ?: config('database.default');

        $table_name = config('landing-pages.database.landing_pages_table');
        Schema::connection($connection)->create($table_name, function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->string('path')->unique();
            $table->string('template')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        Schema::connection($connection)->dropIfExists('landing_pages');
    }
}
