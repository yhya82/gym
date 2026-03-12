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
    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
