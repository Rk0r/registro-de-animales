<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
     public function __construct()
    {
        // Compartir el estado de la BD con todas las vistas de este controlador
        $dbStatus = $this->checkDBConnection();
        view()->share('dbStatus', $dbStatus);
    }
    public function index()
{
    $animales = Animal::orderBy('id', 'desc')->paginate(10);
    $dbStatus = $this->checkDBConnection();
    
    return view('animales.index', compact('animales', 'dbStatus'));
}

    public function create()
    {
        return view('animales.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'max:50',
                'regex:/^[\pL\s\-]+$/u'
            ],
            'especie' => [
                'required',
                'max:50',
                'regex:/^[\pL\s\-]+$/u'
            ],
            'edad' => [
                'required',
                'integer',
                'min:0',
                'max:50'
            ],
            'raza' => [
                'required',
                'max:50',
                'regex:/^[\pL\s\-]+$/u'
            ]
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios',
            'especie.regex' => 'La especie solo puede contener letras y espacios',
            'raza.regex' => 'La raza solo puede contener letras y espacios',
            'edad.integer' => 'La edad debe ser un número entero',
            'edad.min' => 'La edad mínima es 0',
            'edad.max' => 'La edad máxima es 50'
        ]);

        Animal::create($validated);

        return redirect()->route('animales.index')
            ->with('success', 'Animal registrado exitosamente.');
    }

    public function show(Animal $animal)
    {
        return view('animales.show', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        return view('animales.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'max:50',
                'regex:/^[\pL\s\-]+$/u'
            ],
            'especie' => [
                'required',
                'max:50',
                'regex:/^[\pL\s\-]+$/u'
            ],
            'edad' => [
                'required',
                'integer',
                'min:0',
                'max:50'
            ],
            'raza' => [
                'required',
                'max:50',
                'regex:/^[\pL\s\-]+$/u'
            ]
        ], [
            '*.regex' => 'Este campo solo puede contener letras y espacios',
            '*.required' => 'Este campo es obligatorio',
            'edad.*' => 'La edad debe ser un número entre 0 y 50 años'
        ]);

        $animal->update($validated);

        return redirect()->route('animales.index')
            ->with('success', 'Animal actualizado correctamente');
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();
        
        return redirect()->route('animales.index')
            ->with('success', 'Animal eliminado correctamente');
    }
    public function checkDBConnection()
{
    try {
        \DB::connection()->getPdo();
        return true;
    } catch (\Exception $e) {
        return false;
    }
}
}