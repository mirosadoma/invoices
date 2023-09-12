<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
        });
        Schema::create('activities_translations', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->string('locale')->index();
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->foreign('activity_id')->references('id')->on('activities')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['activity_id', 'locale']);
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
        Schema::dropIfExists('activities');
        Schema::dropIfExists('activities_translations');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
