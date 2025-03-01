<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name'];

    public function villes()
    {
        return $this->hasMany(Ville::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // A region can have multiple candidates
    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }
}

