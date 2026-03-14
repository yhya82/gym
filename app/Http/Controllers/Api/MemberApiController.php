<?php

namespace App\Http\Controllers\Api;
use App\Models\Plan;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberApiController extends Controller
{
    public function index(Request $request){
        
        $plans = Plan::all();
        $members = Member::query()
            //search for name and phone
                ->when($request->search , function($q) use ($request) {
                $q->where('name','like','%'.$request->search .'%')
                    ->orWhere('phone','like', '%'.$request->search .'%');
                    })
                //filtering for plan
                ->when($request->plan_id, function($q) use($request){
                   $q->where('plan_id', $request->plan_id);

                   })
                   ->with('plan')
                ->get();
                    

        return response()->json([
            'data' => $members,
            'plans' =>$plans
        ]);
    
    }

    public function store(Request $request){
            $validated = $request->validate([
                'name'=> 'required|string',
                'phone' => 'required|string',
                'gender' => 'required|string',
                'join_date'=>'required|date',
                'plan_id' => 'required|exists:plans,id',
                'amount' => 'required|numeric',
                'payment_method'=> 'required|string',

            ]);

            $member= Member::create($validated);
            //data should be pass to paymnet service
            return response()->json([
        'data' => $member
    ], 201);

    }

    public function update(Request $request, Member $member){

         $validated = $request->validate([
                'name'=> 'required|string',
                'phone' => 'required|string',
                'gender' => 'required|string',
                'join_date'=>'required|date',
                'plan_id' => 'required|exists:plans,id',
                'amount' => 'required|numeric',
                'payment_method'=> 'required|string',

            ]);

            $member->update($validated);

            return response()->json([
                'data'=>$member
            ]);
    }

    public function show(Member $member){

        return response()->json([
            'data'=>$member
        ]);
    }

    public function destroy(Member $member){

    $member->delete();
        return response()->json([
            'message'=>'Member Deleted'
        ]);
    }
}
