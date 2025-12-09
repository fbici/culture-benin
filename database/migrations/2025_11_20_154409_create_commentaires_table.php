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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id('id_commentaire'); 
            $table->text('texte');
            $table->date('date')->default(now());
            $table->integer('note')->nullable(); 
            $table->unsignedBigInteger('id_utilisateur')->nullable(); 
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateurs')->onDelete('set null');           
            $table->unsignedBigInteger('id_contenu'); 
            $table->foreign('id_contenu')->references('id_contenu')->on('contenus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
