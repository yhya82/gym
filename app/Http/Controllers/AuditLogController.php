<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditLog;
use App\Models\User;
class AuditLogController extends Controller
{
  public function index(Request $request){
    $query = AuditLog::with('user')->latest();

    //filter by user 
    if($request->filled('user_id')){
        $query->where('user_id', $request->user_Sid);
    }

    // filter by date
    if($request->filled('start_Date')){
        $query->whereDate('created_at', '>=', $request->start_date);
    }
    if($request->filled('end_date')){
        $query->whereDate('created_at', '<=', $request->end_date);
    }
    $logs = $query->paginate(10)->withQueryString();
    $users = User::all();

    return view('Audit.index', compact('logs', 'users'));
  }  
}
