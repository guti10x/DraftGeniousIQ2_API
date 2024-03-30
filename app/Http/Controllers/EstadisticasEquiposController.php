<?php

namespace App\Http\Controllers;

use App\Models\EstadisticasEquipos;
use Illuminate\Http\Request;

class EstadisticasEquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estadisticasEquipos = EstadisticasEquipos::all();
        return response()->json($estadisticasEquipos);
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
    public function show(EstadisticasEquipos $estadisticasEquipos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EstadisticasEquipos $estadisticasEquipos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadisticasEquipos $estadisticasEquipos)
    {
        //
    }
}
