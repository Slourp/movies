<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->string('poster_path')->nullable()->change();
            $table->string('backdrop_path')->nullable()->change();
            $table->bigInteger('budget')->nullable()->change();
            $table->float('popularity')->nullable()->change();
            $table->date('release_date')->nullable()->change();
            $table->boolean('video')->nullable()->change();
            $table->float('vote_average')->nullable()->change();
            $table->integer('vote_count')->nullable()->change();
            $table->string('original_language')->nullable()->change();
            $table->string('original_title')->nullable()->change();
            $table->string('homepage')->nullable()->change();
            $table->string('imdb_id')->nullable()->change();
            $table->bigInteger('revenue')->nullable()->change();
            $table->integer('runtime')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->text('tagline')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->string('poster_path')->nullable(false)->change();
            $table->string('backdrop_path')->nullable(false)->change();
            $table->bigInteger('budget')->nullable(false)->change();
            $table->float('popularity')->nullable(false)->change();
            $table->date('release_date')->nullable(false)->change();
            $table->boolean('video')->nullable(false)->change();
            $table->float('vote_average')->nullable(false)->change();
            $table->integer('vote_count')->nullable(false)->change();
            $table->string('original_language')->nullable(false)->change();
            $table->string('original_title')->nullable(false)->change();
            $table->string('homepage')->nullable(false)->change();
            $table->string('imdb_id')->nullable(false)->change();
            $table->bigInteger('revenue')->nullable(false)->change();
            $table->integer('runtime')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
            $table->text('tagline')->nullable(false)->change();
        });
    }
};
