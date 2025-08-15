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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('type', [
                'Notes de service',
                'Guides',
                'Manuels de procédures',
                'Textes réglementaires et législatifs',
                'Tarifs',
                'Supports de formation',
                'Organigrammes et répertoire interne',
                'Politiques et chartes internes'
            ]);
            $table->string('fichier');
            $table->string('extension');
            $table->integer('taille')->comment('Taille en bytes');
            $table->string('chemin_fichier');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('est_public')->default(true);
            $table->timestamp('date_publication')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
