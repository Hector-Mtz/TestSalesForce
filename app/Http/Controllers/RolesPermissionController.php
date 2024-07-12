<?php

namespace App\Http\Controllers;

use App\Models\roles_permission;
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
        return Inertia::render('RolesPermisos/Index', 
        [

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
