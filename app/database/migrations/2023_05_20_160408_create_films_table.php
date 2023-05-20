<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('overview');
            $table->string('poster_path')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->unsignedBigInteger('budget')->default(0);
            $table->float('popularity');
            $table->date('release_date');
            $table->boolean('video');
            $table->float('vote_average');
            $table->integer('vote_count');
            $table->string('original_language');
            $table->string('original_title');
            $table->string('homepage')->nullable();
            $table->string('imdb_id')->nullable();
            $table->unsignedBigInteger('revenue')->default(0);
            $table->integer('runtime')->nullable();
            $table->string('status')->nullable();
            $table->text('tagline')->nullable();
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
        Schema::dropIfExists('films');
    }
}
