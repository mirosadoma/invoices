<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsAndConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_and_conditions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('terms_and_conditions_translations', function (Blueprint $table) {
            $table->id();
            $table->longText('content')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('condition_id')->nullable();
            $table->foreign('condition_id')->references('id')->on('terms_and_conditions')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['condition_id', 'locale']);
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
        Schema::dropIfExists('terms_and_conditions');
        Schema::dropIfExists('terms_and_conditions_translations');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
