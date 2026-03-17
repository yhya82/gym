<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{   Protected $fillable =[
    'member_id',
    'plan_id',
    //'user_id',
    'amount',
    'start_date',
    'expiry_date',
    'payment_method',
                        ];


       //relationship
       public function user(){
        return $this->belongsTo(User::class);
       } 
       
       public function member(){
        return $this->belongsTo(Member::class);
       }

       public function plan(){
        return $this->belongsTo(Plan::class);
       }
}
