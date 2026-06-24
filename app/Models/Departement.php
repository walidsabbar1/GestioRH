<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'localisation',
        'description',
    ];

    /**
     * Un département a plusieurs employés.
     */
    public function employes(): HasMany
    {
        return $this->hasMany(Employe::class);
    }

    /**
     * Nombre d'employés dans le département.
     */
    public function getNombreEmployesAttribute(): int
    {
        return $this->employes()->count();
    }
}
