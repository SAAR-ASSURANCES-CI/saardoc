<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'type',
        'fichier',
        'extension',
        'taille',
        'chemin_fichier',
        'user_id',
        'est_public',
        'date_publication'
    ];

    protected $casts = [
        'est_public' => 'boolean',
        'date_publication' => 'datetime',
        'taille' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTailleFormateeAttribute(): string
    {
        $bytes = $this->taille;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getIconeTypeAttribute(): string
    {
        return match($this->type) {
            'Notes de service' => 'document-text',
            'Guides' => 'book-open',
            'Manuels de procédures' => 'clipboard-document-list',
            'Textes réglementaires et législatifs' => 'scale',
            'Tarifs' => 'currency-dollar',
            'Supports de formation' => 'academic-cap',
            'Organigrammes et répertoire interne' => 'squares-2x2',
            'Politiques et chartes internes' => 'shield-check',
            default => 'document'
        };
    }
}
