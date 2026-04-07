<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    Protected $fillable = [
            'plan_id',
            'name',
            'phone',
            'gender',
            'join_date',
            'status',
        ]; 

        //relationship
        public function payment(){
            return $this->hasOne(Payment::class);
        }

        public function plan(){
            return $this->belongsTo(Plan::class);
        }
}
