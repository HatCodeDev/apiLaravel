<?php

namespace App\Http\Controllers;

use App\Models\Tostado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TostadoController extends Controller
{
    
    public function index()
    {
        $tostados = Tostado::all();
        return response()->json($tostados);
    }

    
    public function store(Request $request)
    {
        $rules = ['name' => 'required|string|min:1|max:150'];
        $validator = Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' =>$validator->errors()->all()
            ],400);
        }
        $tostado = new Tostado($request->input());
        $tostado->save();
        return response()->json([
            'status' => true,
            'message' => 'Tipo de tostado creado exitosamente'
        ],200);
    }

 
    public function show(Tostado $tostado)
    {
        return response()->json(['status' => true, 'data' => $tostado]);
    }

    public function update(Request $request, Tostado $tostado)
    {
        $rules = ['name' => 'required|string|min:1|max:150'];
        $validator = Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' =>$validator->errors()->all()
            ],400);
        }
        $tostado->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Tipo de tostado actualizado exitosamente'
        ],200);
    }

    
    public function destroy(Tostado $tostado)
    {
        $tostado->delete();
        return response()->json([
            'status' => true,
            'message' => 'Tipo de tostado eliminado exitosamente'
        ],200);
    }
}
