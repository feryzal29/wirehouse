<?php

namespace App\Http\Controllers;

use App\Models\plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plan = plan::all();
        return view('planMaster',compact(['plan']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);  
        
        $plan = plan::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with(['success'=>'Data Berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = plan::findOrfail($id);
        $data->delete();
        return redirect()->back();
    }
}
