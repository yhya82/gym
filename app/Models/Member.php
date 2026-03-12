<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    Protected $fillable = [
            'name',
            'phone',
            'gender',
            'join_date',
            'status',
        ]; 

        //relationship
        public function payment(){
            return $this->hasMany(Payment::class);
        }
}
