<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function departement()
    {
        return $this->belongsTo(Departement::class,'departements_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class,'employes_id');
    }
    
}
