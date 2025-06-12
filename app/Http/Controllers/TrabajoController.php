<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Http\Requests\StoreTrabajoRequest;
use App\Http\Requests\UpdateTrabajoRequest;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $trabajos = Trabajo::all();
        return view('pages.trabajos.index');
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
    public function store(StoreTrabajoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Trabajo $trabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trabajo $trabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrabajoRequest $request, Trabajo $trabajo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajo $trabajo)
    {
        //
    }
}
