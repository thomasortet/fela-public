<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('episode_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('episode_tag');
    }
}
