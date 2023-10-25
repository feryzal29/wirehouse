<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDO;

class UserController extends Controller
{
    public function index (){
        $user = User::all();
        return view('UserMaster',compact(['user']));
    }

    public function store (Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->assignRole('user');

        return redirect()->back()->with(['success'=>'Data Berhasil ditambah']);
    }

    public function show($id){
        $user = User::find($id);
        return view('UserMasterUpdate',compact(['user']));
    }

    public function update(Request $request, User $user){
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        return redirect()->route('master.user.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy (User $user){
        $user->delete();
        return redirect()->back()->with(['success'=>'Data Berhasil dihapus']);
    }
    
}
