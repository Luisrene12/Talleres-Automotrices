<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenTrabajo;

class OrdenTrabajoController extends Controller
{
    public function index(Request $request)
    {
        $query = OrdenTrabajo::with([
            'cliente:idCliente,nombreCompleto,ci_nit,telefono',
            'vehiculo:idVehiculo,placa,marca,modelo',
            'mecanico:idMecanico,nombreCompleto,especialidad'
        ]);

        if ($request->has('page')) {
            return response()->json($query->latest('idOrdenTrabajo')->paginate(30));
        }

        return response()->json($query->latest('idOrdenTrabajo')->get());
    }

    public function store(\App\Http\Requests\StoreOrdenTrabajoRequest $request)
    {
        $validated = $request->validated();
        $validated['estado'] = 'Recibido'; // Por defecto al crear
        $validated['fechaIngreso'] = now();

        $item = OrdenTrabajo::create($validated);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = OrdenTrabajo::with(['cliente', 'vehiculo', 'mecanico'])->findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = OrdenTrabajo::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = OrdenTrabajo::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

    // FASE 1.A: Portal Recepcionista - Actualizar estado (ej. de Recibido a En reparación)
    public function updateEstado(\App\Http\Requests\UpdateEstadoOrdenRequest $request, $id)
    {
        $orden = OrdenTrabajo::findOrFail($id);
        $validated = $request->validated();
        
        $orden->estado = $validated['etapa'];
        
        if ($validated['etapa'] === 'Terminado') {
            $orden->fechaSalida = now();
        }

        $orden->save();
        return response()->json($orden);
    }

    // FASE 2.A: Portal Mecánico - Aceptar orden (iniciar trabajo)
    public function aceptar(Request $request, $id)
    {
        $orden = OrdenTrabajo::findOrFail($id);
        
        $user = $request->user();
        if (!$user) return response()->json(['message' => 'No autenticado'], 401);

        $mecanico = \App\Models\Mecanico::where('idUsuario', $user->idUsuario)->first();
        if (!$mecanico) return response()->json(['message' => 'No es un mecánico válido'], 403);

        // Opcional: validar que no tenga otra orden activa o que esté disponible
        if ($orden->idMecanico && $orden->idMecanico !== $mecanico->idMecanico) {
            return response()->json(['message' => 'La orden ya está asignada a otro mecánico'], 400);
        }

        $orden->idMecanico = $mecanico->idMecanico;
        $orden->estado = 'En reparación';
        $orden->horaInicio = now();
        $orden->save();

        return response()->json([
            'message' => 'Orden aceptada e iniciada',
            'orden' => $orden
        ]);
    }
}
