<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return response()->json(Cliente::withCount('vehiculos')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreCompleto' => 'required|string|max:150',
            'ci_nit' => 'required|string|max:20|unique:cliente,ci_nit',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $cliente = Cliente::create($validated);
        return response()->json($cliente, 201);
    }

    public function show($id)
    {
        $cliente = Cliente::with('vehiculos')->find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response()->json($cliente);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombreCompleto' => 'sometimes|required|string|max:150',
            'ci_nit' => 'sometimes|required|string|max:20|unique:cliente,ci_nit,' . $id . ',idCliente',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $cliente->update($validated);
        return response()->json($cliente);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        $cliente->delete();
        return response()->json(['message' => 'Cliente eliminado con éxito']);
    }
}
