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
        Schema::create('contenus', function (Blueprint $table) {
            $table->id('id_contenu');
            $table->string('titre');
            $table->unsignedBigInteger('id_type_contenu');
            $table->foreign('id_type_contenu')->references('id_type')->on('type_contenus')->onDelete('restrict');            
            $table->unsignedBigInteger('id_auteur');
            $table->foreign('id_auteur')->references('id_utilisateur')->on('utilisateurs')->onDelete('restrict');           
            $table->unsignedBigInteger('id_region');
            $table->foreign('id_region')->references('id_region')->on('regions')->onDelete('restrict');    
            $table->unsignedBigInteger('id_langue');
            $table->foreign('id_langue')->references('id_langue')->on('langues')->onDelete('restrict');
            $table->unsignedBigInteger('id_parent')->nullable(); 
            $table->foreign('id_parent')->references('id_contenu')->on('contenus')->onDelete('set null');
            $table->unsignedBigInteger('id_moderateur')->nullable();
            $table->foreign('id_moderateur')->references('id_utilisateur')->on('utilisateurs')->onDelete('set null');
            $table->text('texte')->nullable();
            $table->date('date_creation')->default(now());
            $table->integer('statut')->default(1); 
            $table->date('date_validation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
