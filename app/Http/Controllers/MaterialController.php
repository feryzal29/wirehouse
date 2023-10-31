<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $material = Material::all();
        return view('materialMaster',compact('material'));
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
            'material_code' => 'required',
            'material_description' => 'required',
            'mnemonic' => 'required',
            'part_number' => 'required'
        ]);  
        
        $material = Material::create([
            'material_code' => $request->material_code,
            'material_description' => $request->material_description,
            'mnemonic' => $request->mnemonic,
            'part_number' => $request->part_number
        ]);

        return redirect()->back()->with(['success'=>'Data Berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return view('materialMasterUpdate',compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $material->update([
            'material_code' => $request->input('material_code'),
            'material_description' => $request->input('material_description'),
            'mnemonic' => $request->input('mnemonic'),
            'part_number' => $request->input('part_number')
        ]);

        return redirect()->route('master.material.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Material::findOrfail($id);
        $data->delete();
        return redirect()->back();
    }
}
