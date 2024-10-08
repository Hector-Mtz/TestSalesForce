<?php

namespace App\Http\Controllers;

use App\Models\permission;
use App\Models\roles_permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getPermisosByRol(Request $request)
    {
        $permissions = roles_permission::select('roles_permissions.permission_id')
        ->where('roles_permissions.role_id','=',$request['rol'])
        ->get();
        
        return response()->json([
          'permissonId' => $permissions->pluck('permission_id')
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
        permission::updateOrCreate([
            'nombre' => $request['nombre']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(permission $permission)
    {
        //
    }
}
