<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });
        Schema::create('countries_translations', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['country_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('countries_translations');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
