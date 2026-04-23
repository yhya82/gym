<?php

namespace App\Http\Controllers\Api;
use App\Models\Payment;
use App\Models\Member;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardApiController extends Controller
{
    public function index(){
            $username = Auth::user()->name;
            $totalrevenue = Payment::sum('amount');
            $totalmonthly =Payment::whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                         ])->sum('amount');
            $totalmembers = Member::count();
            $activemembers = Member::where('status','active')->count();
            $expiredmembers = Member::where('status','expired')->count();
            $now = now()->format('l, d M Y ');
            $revenue = DB::table('payments')
                            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                            ->groupBy('month')
                            ->pluck('total','month');

                            //make the months in an array an loop through it
                            $labels = [];
                            $data = [];
                            for($i = 1; $i <= 12; $i++){
                                $labels[] = date("M", mktime(0,0,0,$i,1));
                                $data[] = $revenue[$i] ?? 0;
                            }


            return response()->json([
                'total_revenue' =>$totalrevenue,
                'monthly_revenue'=>$totalmonthly,
                'total_members' => $totalmembers,
                'active_members'=> $activemembers,
                'expired_members'=>$expiredmembers,
                'now'=>$now,
                'labels' => $labels,
                'data' =>$data
            ]);

        }
}
