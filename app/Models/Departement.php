<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function employes()
    {
        return $this->hasMany(Employe::class,'departements_id');
    }
}
