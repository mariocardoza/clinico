<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unidad;

class UnidadesController extends Controller
{
    public function index()
    {
        $unidades=Unidad::get();
        return $unidades;
    }
    public function store(Request $request)
    {
        return Unidad::create($request->all());

    }
    public function update(Request $request, $id)
    {
        $unidad=Unidad::find($id);
        $unidad->fill($request->all());
        $unidad->save();
        return $unidad;
    }
    public function destroy($id)
    {
        $unidad = Unidad::findOrFail($id);
        if($unidad)
            $unidad->delete();
        else
            return response()->json('error');
        return response()->json(null);
    }
}
