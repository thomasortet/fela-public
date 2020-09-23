<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->foreignId('presentateur_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('numero_episode');
            $table->string('saison');
            $table->foreignId('note_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('lien')->nullable();
            $table->string('lieu');
            $table->integer('annee');
            $table->text('description');
            $table->text('commentaire')->nullable();
            $table->timestamps();
            $table->unique('titre');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
