<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Http\Requests\ServicioRequest;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::orderBy('id', 'DESC')->paginate(5);
        return view('servicio.index', compact('servicios'));
    }

    public function store(ServicioRequest $request)
    {
        Servicio::create($request->validated());

        return redirect()->route('servicio.index')
                         ->with('success', 'Servicio registrado correctamente.');
    }

    public function update(ServicioRequest $request, Servicio $servicio)
    {
        $servicio->update($request->validated());

        return redirect()->route('servicio.index')
                         ->with('success', 'Servicio actualizado correctamente.');
    }
    
}