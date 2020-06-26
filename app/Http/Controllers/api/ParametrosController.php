<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Parametro;
use Illuminate\Validation\ValidationException;

class ParametrosController extends Controller
{
    public function index()
    {
        $parametros=Parametro::get();
        return $parametros;
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nombre'    => 'required|unique:parametros',
            ]);
        }
        catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        }
        return Parametro::create($request->all());
    }
    public function update(Request $request, $id)
    {
        $parametro=Parametro::find($id);
        $parametro->fill($request->all());
        $parametro->save();
        return $parametro;
    }
    public function destroy($id)
    {
        $parametro = Parametro::findOrFail($id);
        if($parametro)
            $parametro->delete();
        else
            return response()->json('error');
        return response()->json(null);
    }
}
