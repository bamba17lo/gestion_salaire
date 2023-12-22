<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function employe(){
        return $this->belongsTo(Employe::class, 'employes_id');
    }
}
