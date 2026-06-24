<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'fonction',
        'salaire',
        'date_embauche',
        'photo',
        'departement_id',
    ];

    protected function casts(): array
    {
        return [
            'salaire' => 'decimal:2',
            'date_embauche' => 'date',
        ];
    }

    /**
     * Un employé appartient à un département.
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Nom complet de l'employé.
     */
    public function getNomCompletAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Salaire formaté en MAD.
     */
    public function getSalaireFormateAttribute(): string
    {
        return number_format((float) $this->salaire, 2, ',', ' ') . ' MAD';
    }

    /**
     * Date d'embauche formatée en français.
     */
    public function getDateEmbaucheFormateeAttribute(): string
    {
        return $this->date_embauche->translatedFormat('d F Y');
    }

    /**
     * URL de la photo ou avatar par défaut.
     */
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nom_complet) . '&background=2563EB&color=fff&size=128';
    }
}
