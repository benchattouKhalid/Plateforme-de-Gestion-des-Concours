<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concours extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'description', 'specialiste', 'dateFin', 'dateDebut', 'centre_id','grade','avis' , 'resultat_ecrit',
        'resultat_orale',
        'age_limit',
        'nombres_de_postes',
        'date_concours',
    ];

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }
   
}
