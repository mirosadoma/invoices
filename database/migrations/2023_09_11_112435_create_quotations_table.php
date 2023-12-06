<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->string('signature')->nullable();
            $table->tinyInteger('is_tax')->default(0);
            $table->enum('currance',['USD','EGP','SAR','AED'])->nullable();
            $table->enum('status',['waiting','approved','un_approved'])->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('user_type',['client','freelancer'])->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('quotations_activities', function (Blueprint $table) {
            $table->id();
            $table->float('price')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('quotation_id')->nullable();
            $table->foreign('quotation_id')->references('id')->on('quotations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->foreign('activity_id')->references('id')->on('activities')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('quotations');
        Schema::dropIfExists('quotations_activities');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
