<?php

namespace App\Http\Controllers;

use App\Http\Requests\MecanicoRequest;
use App\Models\mecanico;

class MecanicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mecanicos = mecanico::orderBy('id', 'DESC')->paginate(4);

        return view('mecanico.index', compact('mecanicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MecanicoRequest $request)
    {
        //
        $datosValidos = $request->validated();
        mecanico::create($datosValidos);

        return redirect()->route('mecanico.index')
            ->with('success', 'Mecanico registrado correctamente.');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MecanicoRequest $request, $id)
    {
        //
        $mecanico = mecanico::findOrFail($id);
        $mecanico->update($request->validated());

        return redirect()->route('mecanico.index')
            ->with('success', 'Mecanico actualizado correctamente.');
    }
}
