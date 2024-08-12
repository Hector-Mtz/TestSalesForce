<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 

    public function index(Request $request)
    {
       return User::select('users.*')
       ->where('users.role_id','=',2) //unicamente vendedores base
       ->get();
    }

    public function store(Request $request)
    {
        User::updateOrCreate(
          ['email' => $request['email'],],
          [
            'name' => $request['nombre'],
            'ap_paterno' => $request['ap_paterno'],
            'ap_materno' => $request['ap_materno'],
            'role_id' => $request['role_id'],
            'gerente' => $request['gerente'],
            'coordinador' => $request['coordinador'],
            'password' => $request['password']
           ]);
    
           return redirect()->back();
    }
}
