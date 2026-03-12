<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();

        return view('plan.index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate ([
            'name' => 'required',
            'price' => 'required',
            'duration' => 'required',
        ]);

        Plan::create($request->all());
        return redirect()->route('plans.index')->with('Success', 'Plan Created Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view ('plan.edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'duration' => 'required',
        ]);

        $plan->update($request->all());

        return redirect()->route('plans.index')->with('Sucess','Plan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('Sucess', 'Plan deleted');
    }
}
