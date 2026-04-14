<?php

namespace App\Http\Controllers\Api;
use App\Models\Plan;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PaymentService;

class MemberApiController extends Controller
{

    protected $paymentservice;

    public function __construct(PaymentService $paymentservice){
        $this->paymentservice = $paymentservice;
    }

    public function index(Request $request){
        
      
        $members = Member::query()
            //search for name and phone
                ->when($request->search , function($q) use ($request) {
                    $q->where(function($query) use ($request){
                        $query->where('name','like','%'.$request->search .'%')
                                ->orWhere('phone','like', '%'.$request->search .'%');

                        });
                    })
                //filtering for plan
                ->when($request->plan_id, function($q) use($request){
                   $q->where('plan_id', $request->plan_id);

                   })
                   ->with('plan','payment.user')
                    ->get();
                    

        return response()->json([
            'data' => $members,
            
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
                
            try{
                     
            $result = $this->paymentservice->createMemberPayment($validated);

             return response()->json([

             'message' => 'Member created successfully',
                'data' => $result['member']
            ], 201);

            }catch(\Exception $e){
                
                return response()->json([
                    'message'=>$e->getMessage()
                ]);
            }

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

            //update member table
            $member->update([
                
                    'name'=>$validated['name'],
                    'phone'=>$validated['phone'],
                    'join_date'=>$validated['join_date'],
                     'plan_id'=>$validated['plan_id'],
                    ]);

                    //update the payment table through the relationship with members table
                    $member->payment()->update([
                        'member_id'=>$member->id,
                        'amount'=>$validated['amount'],
                        'payment_method'=>$validated['payment_method']
                    ]);


            return response()->json([
                'data'=>$member->load('plan','payment')
            ]);
    }

    public function show(Member $member){
            //return payments ad plan if not the edit form would show only the member

            $member->load('plan','payment');
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
