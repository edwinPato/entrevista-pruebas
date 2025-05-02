<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Models\Baja;
use Illuminate\Http\Request;

class BajaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $activo = Activo::select('activos.*')
        ->selectSub(function ($query) {
            $query->from('bajas')
                  ->selectRaw('COALESCE(SUM(cantidad), 0)')
                  ->whereColumn('bajas.activo_id', 'activos.id');
        }, 'total_bajas')
        ->where('activos.id', $id)
        ->first();
        $activo->stock_actual = $activo->cantidad_inicial - $activo->getAttribute('total_bajas');
        return view('activos.baja', compact('activo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $activo = Activo::select('activos.*')
        ->selectSub(function ($query) {
            $query->from('bajas')
                  ->selectRaw('COALESCE(SUM(cantidad), 0)')
                  ->whereColumn('bajas.activo_id', 'activos.id');
        }, 'total_bajas')
        ->where('activos.id', $id)
        ->first();
        $activo->stock_actual = $activo->cantidad_inicial - $activo->getAttribute('total_bajas');

        $request->validate([
            "cantidad" => "required|numeric|min:0|max:$activo->stock_actual",
            "motivo" => "required|max:150",
            "fecha" => "required|date",
        ], [
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.numeric' => 'El campo cantidad debe ser un número.',
            'cantidad.min' => 'El campo cantidad no puede ser negativo.',
            'cantidad.max' => 'La cantidad no puede exceder el stock actual del activo.',
            'motivo.required' => 'El campo motivo es obligatorio.',
            'motivo.max' => 'El campo motivo no debe exceder los 150 caracteres.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'fecha.date' => 'El campo fecha debe ser una fecha válida.'
        ]);
        $baja = new Baja();
        $baja->cantidad = $request->cantidad;
        $baja->activo_id = $id;
        $baja->motivo = $request->motivo;
        $baja->fecha = $request->fecha;
        if($baja->save()) {
            return redirect()->route('activos.index')->with('success', 'La baja ha sido registrada exitosamente.');
        }else {
            return redirect()->back()->with('error', 'Error al registrar la baja.');
        }
    }
}
