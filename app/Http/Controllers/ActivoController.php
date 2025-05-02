<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use Illuminate\Http\Request;

class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $datos = Activo::select('activos.*')
        ->selectSub(function ($query) {
            $query->from('bajas')
                  ->selectRaw('COALESCE(SUM(cantidad), 0)')
                  ->whereColumn('bajas.activo_id', 'activos.id');
        }, 'total_bajas')
        ->when($search, function ($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                  ->orWhere('codigo', 'like', "%$search%");
            });
        })
        ->orderBy('id')
        ->paginate(10); 

        $datos->getCollection()->transform(function ($activo) {
            $totalBajas = $activo->getAttribute('total_bajas');
            $activo->stock_actual = $activo->cantidad_inicial - $totalBajas;
            return $activo;
        });

        return view('activos.index', compact('datos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|max:40",
            "descripcion" => "required|max:150",
            "cantidad" => "required|numeric|min:0",
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no debe exceder los 40 caracteres.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.max' => 'El campo descripción no debe exceder los 150 caracteres.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.numeric' => 'El campo cantidad debe ser un número.',
            'cantidad.min' => 'El campo cantidad no puede ser negativo.'
        ]);
        $ultimoCodigo = Activo::latest()->value('codigo');
        if ($ultimoCodigo) {
            $numero = (int) substr($ultimoCodigo, 2);
            $nuevoNumero = $numero + 1;
        } else {
            $nuevoNumero = 1;
        }
        $nuevoNumeroFormateado = str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT); 
        $nuevoCodigo = 'CM' . $nuevoNumeroFormateado; 
        $item = new Activo();
        $item->nombre = $request->nombre;
        $item->codigo = $nuevoCodigo;
        $item->descripcion = $request->descripcion;
        $item->cantidad_inicial = $request->cantidad;
        if($item->save()) {
            return redirect()->route('activos.index')->with('success', 'El registro ha sido agregado exitosamente.');
        }else {
            return redirect()->back()->with('error', 'Error al registrar.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activo = Activo::find($id);
        return view('activos.edit', compact('activo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            "nombre" => "required|max:40",
            "descripcion" => "required|max:150",
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no debe exceder los 40 caracteres.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.max' => 'El campo descripción no debe exceder los 150 caracteres.'
        ]);
        $item = Activo::find($id);
        $item->nombre = $request->nombre;
        $item->descripcion = $request->descripcion;
        if($item->save()) {
            return redirect()->route('activos.index')->with('success', 'El registro ha sido modificado exitosamente.');
        }else {
            return redirect()->back()->with('error', 'Error al modificar el registro.');
        }
    }
}
