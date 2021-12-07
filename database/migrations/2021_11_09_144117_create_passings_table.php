<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreatePassingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passings', function (Blueprint $table) {
            $table->id();
            $table->string('nickname')->unique();
            $table->integer('correct_answers')->nullable();
            $table->integer('total_answers')->default(Config::get('app.questionCount'));// Should take this from app config
            $table->integer('current_question')->default('1');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passings');
    }
}
