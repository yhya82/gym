<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
     Protected $fillable = [
        'name',
        'price',
        'duration',
    ];

    //relationship
    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function members(){
        return $this->hasMany(Member::class);
    }
}
