<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('type_contenus', function (Blueprint $table) {
            $table->string('slug', 120)->unique()->after('nom'); // Ajout du slug après le nom
            $table->string('icone_css', 50)->nullable()->after('slug'); // Ajout de l'icône
            $table->text('description')->nullable()->after('icone_css'); // Ajout de la description
        });
    }

    public function down(): void
    {
        Schema::table('type_contenus', function (Blueprint $table) {
            $table->dropColumn(['description', 'icone_css', 'slug']);
        });
    }
};