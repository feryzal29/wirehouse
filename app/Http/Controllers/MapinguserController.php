<?php

namespace App\Http\Controllers;

use App\Models\mapinguser;
use App\Models\plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapinguserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maping = DB::table('mapingusers')
                    ->join('users', 'users.id', '=', 'mapingusers.user_id')
                    ->join('plans', 'plans.id', '=', 'mapingusers.plan_id')
                    ->select('users.name as namee', 'plans.name as planename', 'mapingusers.*')
                    ->get();
        return view('MapingPlanUser',compact(['maping']));
    }

    public function add(){
        $user = User::all();
        $plan = plan::all();
        return view('MapingUserPlanAdd',compact(['user','plan']));
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
            'user_id'=>'required',
            'plan_id'=>'required'
        ]);

        $maping = mapinguser::create([
            'user_id'=> $request->user_id,
            'plan_id'=> $request->plan_id
        ]);

        return redirect()->route('master.maping.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(mapinguser $mapinguser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mapinguser $mapinguser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mapinguser $mapinguser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mapinguser $mapinguser)
    {
        //
    }
}
