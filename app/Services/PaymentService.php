<?php
namespace App\Services;
use App\Models\Member;
use App\Models\Plan;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PaymentService{

    Public function createMemberPayment($validated){

        return DB::transaction(function() use($validated) { 
            //createmember
            $member = Member::create([
                'plan_id'=>$validated['plan_id'],
                'name'=>$validated['name'],
                'phone'=>$validated['phone'],
                'gender'=>$validated['gender'],
                'join_date'=>$validated['join_date']
            ]);

                //create payment

                //get plan cause the expiry date depends on plan

                $plan = Plan::FindOrFail($validated['plan_id']);
                $startDate = Carbon::today();
                $expiryDate = $startDate->copy()->addDays($plan->duration);

                $payment = Payment::create([
                    'member_id' => $member->id,
                    'plan_id'=> $plan->id,
                   // 'user_id'=> auth()->id(),
                    'amount'=>$validated['amount'],
                    'start_date'=>$startDate,
                    'expiry_date'=>$expiryDate,
                    'payment_method'=>$validated['payment_method'],
                    
                ]);

                //updating member status
                $member->status='active';
                $member->save();

                return  [
                    'member' => $member,
                    'payment' =>$payment,
                ];
        });
    }
}