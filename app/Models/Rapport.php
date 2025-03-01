<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;
    protected $fillable = [
        'concours_id', 'statistique', 'user_id'
    ];

    public function concours()
    {
        return $this->belongsTo(Concours::class);
    }

    public function gestionnaire()
    {
        return $this->belongsTo(User::class);
    }
}
