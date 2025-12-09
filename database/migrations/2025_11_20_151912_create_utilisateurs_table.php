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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id('id_utilisateur');
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('email')->unique();
            $table->string('mot_de_passe');
           
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('restrict');
            
            $table->char('sexe', 1)->nullable(); 
            
            $table->unsignedBigInteger('id_langue')->nullable();
            $table->foreign('id_langue')->references('id_langue')->on('langues')->onDelete('set null');
            
            $table->date('date_inscription')->default(now());
            $table->date('date_naissance')->nullable();
            $table->integer('statut')->default(1); 
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
