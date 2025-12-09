<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->id('id_achat');
            $table->foreignId('id_utilisateur')->constrained('users')->onDelete('cascade');
            $table->enum('type_item', ['contenu', 'media']);
            $table->unsignedBigInteger('id_item');
            $table->decimal('montant', 10, 2);
            $table->string('devise', 10)->default('FCFA');
            $table->enum('statut', ['en_attente', 'complété', 'échoué', 'annulé'])->default('en_attente');
            $table->string('reference_paiement', 100)->unique();
            $table->string('transaction_id')->nullable();
            $table->timestamp('date_paiement')->nullable();
            $table->timestamps();

            // Index pour les recherches
            $table->index(['id_utilisateur', 'type_item', 'id_item']);
            $table->index('reference_paiement');
            $table->index('transaction_id');
            $table->index(['statut', 'date_paiement']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('achats');
    }
};