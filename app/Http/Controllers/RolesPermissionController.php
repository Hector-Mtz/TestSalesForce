<?php

namespace App\Http\Controllers;

use App\Models\permission;
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
        $usuarios = User::select('users.*','roles.nombre as rol')
        ->join('roles', 'users.role_id','roles.id')
        ->paginate(10);

        $roles = role::select('roles.*')
        ->get();

        $permisos = permission::select('permissions.*')
        ->get();

        return Inertia::render('RolesPermisos/Index', 
        [
           'usuarios' => $usuarios,
           'roles' => $roles,
           'permisos' => $permisos
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

    public function setPermission (Request $request)
    {
        $role = role::select('roles.*')
        ->where('id','=',$request['rol'])
        ->first();

        if ($request['checked']) 
        {
            $role->permissions()->attach([$request['permission']]);
        } else {
            $role->permissions()->detach([$request['permission']]);
        }
        return response()->json([
            'message' => 'ok'
        ]);
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
