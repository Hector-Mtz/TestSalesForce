<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\roles_permission;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RolesPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios = User::select('users.*')
        ->paginate(10);

        $roles = role::select('roles.*')
        ->paginate(10);

        return Inertia::render('RolesPermisos/Index', 
        [
           'usuarios' => $usuarios
        ]);
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
    public function show(roles_permission $roles_permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(roles_permission $roles_permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, roles_permission $roles_permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(roles_permission $roles_permission)
    {
        //
    }
}
