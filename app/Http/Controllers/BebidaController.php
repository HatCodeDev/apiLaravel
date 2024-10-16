<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use Illuminate\Http\Request;
use App\Models\Tostado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BebidaController extends Controller
{
    public function index()
    {
        $bebidas = Bebida::select('bebidas.*', 'tostados.name as tostado')
        ->join('tostados', 'tostados.id', '=', 'bebidas.tostados_id')
        ->paginate(10);
        return response()->json($bebidas);
    }
    public function store(Request $request)
    {
        $rules = [
            'tipo' => 'required|string|max:80',                  
            'tostados_id' => 'required|exists:tostados,id',      
            'precio' => 'required|numeric|min:0|max:999.99',     
            'filtracion' => 'required|string|max:100',           
            'altura' => 'required|string|max:50',                
            'complementos' => 'required|string|max:100',         
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        // Subir la imagen y cambiar el nombre
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = now()->format('Ymd_His') . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/imagenes_bebidas', $imageName);
        }

        // Guardar la bebida con la ruta de la imagen
        $bebida = new Bebida($request->all());
        $bebida->imagen = 'imagenes_bebidas/' . $imageName;
        $bebida->save();

        return response()->json([
            'status' => true,
            'message' => 'Bebida creada exitosamente',
            'data' => $bebida
        ], 200);
    }

    public function show(Bebida $bebida)
    {
        return response()->json(['status' => true, 
        'data' => $bebida]);
    }

    public function update(Request $request, Bebida $bebida)
{
    // Validar los campos de la solicitud
    $rules = [
        'tipo' => 'required|string|max:80',
        'tostados_id' => 'required|exists:tostados,id',
        'precio' => 'required|numeric|min:0|max:999.99',
        'filtracion' => 'required|string|max:100',
        'altura' => 'required|string|max:50',
        'complementos' => 'required|string|max:100',
        'imagen' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048' // Imagen opcional
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()->all()
        ], 400);
    }

    // Si se sube una nueva imagen, manejar la eliminación de la anterior y subir la nueva
    if ($request->hasFile('imagen')) {
        // Eliminar la imagen anterior si existe
        if ($bebida->imagen && Storage::exists('public/' . $bebida->imagen)) {
            Storage::delete('public/' . $bebida->imagen);
        }

        // Subir la nueva imagen
        $image = $request->file('imagen');
        $imageName = now()->format('Ymd_His') . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/imagenes_bebidas', $imageName);

        // Asignar la nueva ruta de la imagen al modelo
        $bebida->imagen = 'imagenes_bebidas/' . $imageName;
    }

    // Actualizar todos los campos de la bebida (incluso los que no son archivos)
    $bebida->update($request->only([
        'tipo', 
        'tostados_id', 
        'precio', 
        'filtracion', 
        'altura', 
        'complementos'
    ]));

    return response()->json([
        'status' => true,
        'message' => 'Bebida actualizada exitosamente',
        'data' => $bebida
    ], 200);
}

    public function destroy(Bebida $bebida)
    {
        // Eliminar la imagen asociada
        if (Storage::exists('public/' . $bebida->imagen)) {
            Storage::delete('public/' . $bebida->imagen);
        }

        // Eliminar la bebida
        $bebida->delete();

        return response()->json([
            'status' => true,
            'message' => 'Bebida eliminada exitosamente'
        ], 200);
    }
    public function BebidasByTostado()
    {
        $bebidas = Bebida::select(DB::raw('count(bebidas.id) as count,
        tostados.name'))
            ->rightjoin('tostados','tostados.id','=','bebidas.tostados_id')
            ->groupBy('tostados.name')->get();
        return response()->json($bebidas);
    }

    public function all(){
        $bebidas = Bebida::select('bebidas.*', 
        'tostados.name as tostado')
        ->join('tostados', 'tostados.id', '=', 'bebidas.tostados_id')
        ->get();
        return response()->json($bebidas);
    }
}
