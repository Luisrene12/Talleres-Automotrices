<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnostico;

class DiagnosticoController extends Controller
{
    public function index()
    {
        return response()->json(Diagnostico::all());
    }

    public function store(Request $request)
    {
        $item = Diagnostico::create($request->all());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Diagnostico::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Diagnostico::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Diagnostico::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
