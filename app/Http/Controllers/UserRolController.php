<?php

namespace App\Http\Controllers;

use App\Models\UserRol;
use App\Http\Requests\StoreUserRolRequest;
use App\Http\Requests\UpdateUserRolRequest;

class UserRolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRolRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRol  $userRol
     * @return \Illuminate\Http\Response
     */
    public function show(UserRol $userRol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserRol  $userRol
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRol $userRol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRolRequest  $request
     * @param  \App\Models\UserRol  $userRol
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRolRequest $request, UserRol $userRol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRol  $userRol
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRol $userRol)
    {
        //
    }
}
