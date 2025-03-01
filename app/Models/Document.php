<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_path', 'file_name',  'candidat_id'
    ];

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }
}
