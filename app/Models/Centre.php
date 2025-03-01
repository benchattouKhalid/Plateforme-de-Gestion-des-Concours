<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'adresse', 'places_disponibles', 'specialistes'
    ];

    public function gestionnaire()
    {
        return $this->belongsTo(User::class, 'centre_responsable');
    }

    public function concours()
    {
        return $this->hasMany(Concours::class);
    }
}
