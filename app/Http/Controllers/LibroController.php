<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Proyecto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

/**
 * Class LibroController
 * @package App\Http\Controllers
 */
class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $libros = Libro::where('user_id', $user_id)->paginate();
        $total = $libros->total();

        return view('libro.index', compact('libros', 'total'))
            ->with('i', (request()->input('page', 1) - 1) * $libros->perPage());
    }

    public function pdf($libro_id)
    {
        $user = Auth::user();
        $user_name = Str::words(Auth::user()->name, 1, '');
        $proyectos = Proyecto::where('libros_id', $libro_id)->paginate();
        $libro = Libro::find($libro_id);
        $total_projects = 0;
        $total_price = 0;

        foreach ($proyectos as $proyecto) {
            $total_projects += $proyecto->Cantidad;
            $total_price += $proyecto->subtotal;
        }

        $pdf = PDF::loadView('libro.pdf', ['proyectos' => $proyectos, 'user' => $user,
             'libro' => $libro, 'total_projects' => $total_projects, 'total_price' => $total_price]);
        
        $name = $libro->nombre.'_'.$user_name."-".$libro->created_at->format('dmY');
        $pdf->getDomPDF()->set_option("enable_php", true);
        return $pdf->download("$name.pdf");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $libro = new Libro();
        $user_id = Auth::id();

        return view('libro.create', compact('libro', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Libro::$rules);

        $libro = Libro::create($request->all());

        return redirect()->route('libros.index')
            ->with('success', 'Libro created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libro = Libro::find($id);
        $proyectos = Proyecto::where('libros_id', '=', $id)->paginate();
        $count = $proyectos->total();
        $total = 0;

        foreach ($proyectos as $proyecto) {
            $total += $proyecto->subtotal;
        }

        return view('libro.show', compact('libro', 'proyectos', 'count', 'total'))
            ->with('i', (request()->input('page', 1) - 1) * $proyectos->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = Libro::find($id);
        $user_id = Auth::id();

        return view('libro.edit', compact('libro', 'user_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Libro $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        request()->validate(Libro::$rules);

        $libro->update($request->all());

        return redirect()->route('libros.index')
            ->with('success', 'Libro updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $libro = Libro::find($id)->delete();

        return redirect()->route('libros.index')
            ->with('success', 'Libro deleted successfully');
    }
}
