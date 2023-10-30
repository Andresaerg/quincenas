<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProyectoController
 * @package App\Http\Controllers
 */
class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Proyecto::paginate();

        return view('proyecto.index', compact('proyectos'))
            ->with('i', (request()->input('page', 1) - 1) * $proyectos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $value)
    {
        $proyecto = new Proyecto();
        $user_id = Auth::id();
        $libro = $value->query('libro');
        $libros = Libro::pluck('nombre', 'id');
        $categorias = Categoria::where('user_id', $user_id)->pluck('nombre', 'id');
        $precios = Categoria::pluck('precio', 'id');
        return view('proyecto.create', compact('proyecto', 'libros', 'categorias', 'precios', 'libro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /* public function store(Request $request)
    {
        request()->validate(Proyecto::$rules);

        $proyecto = Proyecto::create($request->all());
        
        $libro = $request->query('libro');

        return redirect()->to("libros/$libro")
            ->with('success', 'Proyecto created successfully.');
    } */

    public function store(Request $request)
    {
        $proyectosData = $request->input('proyectos');
        $libro = $request->query('libro');

        if ($proyectosData === null) {
            request()->validate(Proyecto::$rules);

            $proyecto = Proyecto::create($request->all());
        }else{
            foreach ($proyectosData as $proyectoData) {
                Validator::make($proyectoData, Proyecto::$rules)->validate();
                $proyecto = Proyecto::create($proyectoData);
            }        
        }
    
        return redirect()->to("libros/$libro")
            ->with('success', 'Proyectos creados con éxito.');
    }
    


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyecto = Proyecto::find($id);

        return view('proyecto.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = Proyecto::find($id);
        $libro = $proyecto->libros_id;
        $id_user = Auth::id();
        $libros = Libro::pluck('nombre', 'id');
        $filtrado = Categoria::select()->where('user_id', $id_user);
        $categorias = $filtrado->pluck('nombre', 'id');
        $precios = Categoria::pluck('precio', 'id');

        return view('proyecto.edit', compact('proyecto', 'libros', 'categorias', 'precios', 'libro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Proyecto $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        request()->validate(Proyecto::$rules);

        $proyecto->update($request->all());
        $libro = $request->query('libro');

        return redirect()->to("libros/$libro")
            ->with('success', 'Proyecto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $location = Proyecto::find($id);
        $libro = $location->libros_id;
        $proyecto = Proyecto::find($id)->delete();

        return redirect()->route('libros.show', $libro)
            ->with('success', 'Proyecto deleted successfully');
    }

    public function delete_all($libro){
        $proyectos = Proyecto::where('libros_id', $libro)->delete();

        return redirect()->route('libros.show', $libro)
            ->with('success', 'Proyectos deleted succesfully');
    }
}
