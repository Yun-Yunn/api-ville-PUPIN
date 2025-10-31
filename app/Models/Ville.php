<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $table = 'villes_france_free'; // ✅ nom exact de ta table MySQL
    protected $primaryKey = 'ville_id';     // ✅ clé primaire dans ta table
    public $timestamps = false;             // ✅ pas de created_at / updated_at

    protected $fillable = [
        'ville_nom',
        'ville_code_postal',
        'ville_departement',
        'ville_longitude_deg',
        'ville_latitude_deg',
        'ville_population_2012',
        'ville_slug',
    ];
}
