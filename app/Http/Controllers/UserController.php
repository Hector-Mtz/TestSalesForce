<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 

    public function store(Request $request)
    {
        User::updateOrCreate([
            'name' => $request['nombre'],
            'ap_paterno' => $request['ap_paterno'],
            'ap_materno' => $request['ap_materno'],
            'email' => $request['email'],
            'role_id' => $request['role_id'],
            'password' => $request['password']
           ]);
    
           return redirect()->back();
    }
}
