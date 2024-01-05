<?php

namespace App\Http\Controllers;

use App\Models\Emprunteur;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id){

        $user = User::find($id);
        return view('users.show', ['user'=>$user]);
    }

    public function showAll(){

        $users = User::all();
        return view('users.allUsers', ['users'=>$users]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('lesUsers');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->input('role');
        $user->save();
        return redirect()->route('lesUsers');
    }
}
