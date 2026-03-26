<?php

namespace App\Http\Controllers\Api;
use App\Models\Payment;
use App\Models\Member;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardApiController extends Controller
{
    public function index(){
            $totalrevenue = Payment::sum('amount');
            $totalmonthly =Payment::whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                         ])->sum('amount');
            $totalmembers = Member::count();
            $activemembers = Member::where('status','active')->count();
            $expiredmembers = Member::where('status','expired')->count();

            return response()->json([
                'total_revenue' =>$totalrevenue,
                'monthly_revenue'=>$totalmonthly,
                'total_members' => $totalmembers,
                'active_members'=> $activemembers,
                'expired_members'=>$expiredmembers
            ]);

        }
}
