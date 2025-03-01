<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Candidat extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'nom', 'prenom', 'email', 'CIN', 'telephone', 'adresse', 'date_naissance',
        'niveauEtude','password' ,'region_name' , 'ville_name' , 'sexe' , 'region_id' , 'ville_id','status' , 'lieu_de_naissance' , 'moyenne' ,'specialte_diplome' ,'diplome', 'document', 'candidatNumber' ,'experience_professionelle', 'concours_id', 'status', 'note'
    ];
    protected $hidden = [
       'password'   , 'remember_token',
    ];




    public function concours()
    {
        return $this->belongsTo(Concours::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Generate unique candidatNumber before saving
        static::creating(function ($candidat) {
            $candidat->candidatNumber = 'CN-' . strtoupper(Str::random(8));
             // Generate a plain 6-character password
             // Hash the password

        // Store the plain password in a temporary attribute

        });
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

}
