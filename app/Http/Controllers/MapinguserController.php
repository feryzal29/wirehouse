<?php

namespace App\Http\Controllers;

use App\Models\mapinguser;
use Illuminate\Http\Request;

class MapinguserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maping = mapinguser::all();
        return view('MapingPlanUser',compact(['maping']));
    }

    public function add(){
        return view('MapingUserPlanAdd');
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
        //
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
