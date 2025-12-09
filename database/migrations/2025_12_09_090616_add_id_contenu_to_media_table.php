<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->unsignedBigInteger('id_contenu')->nullable()->after('id_utilisateur');
            $table->foreign('id_contenu')->references('id_contenu')->on('contenus')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropForeign(['id_contenu']);
            $table->dropColumn('id_contenu');
        });
    }
};