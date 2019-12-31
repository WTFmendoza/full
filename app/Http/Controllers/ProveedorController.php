<?php

namespace sisventas\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use sisventas\Http\Requests\PersonaFormRequest;
use sisventas\Persona;
use DB;

use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) 
    {
        if ($request) 
        {
            $query=trim($request->get('searchText'));
            $personas=DB::table('persona')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Proveedor')
            ->orwhere('num_documento','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Proveedor')
            ->orderBy('idpersona','desc')
            ->paginate(7);
            return view('compras.proveedor.index',["personas"=>$personas,"searchText"=>$query]);
        }
    }
    public function create() // funcion de crear//
    {
        return view("compras.proveedor.create");
    }
    public function store (PersonaFormRequest $request)
    {
        $persona=new Persona;
        $persona->tipo_persona='Proveedor';
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');

        $persona->save();
        return Redirect::to('compras/proveedor');

    }
    public function show($id) // funcion de mostrar //
    {
        return view("compras.proveedor.show",["persona"=>Persona::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("compras.proveedor.edit",["persona"=>Persona::findOrFail($id)]);
    }
    public function update(PersonaFormRequest $request,$id) //  funcion deactualizar //
    {
        $persona=Persona::findOrFail($id);
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');

        $persona->update();
        return Redirect::to('compras/proveedor');
    }
    public function destroy($id) // funcion de borrar ojo solo cambia a 0 y lo hace no visible en la tabla//
    {
        $persona=Persona::findOrFail($id);
        $persona->tipo_persona='Inactivo';
        $persona->update();
        return Redirect::to('compras/proveedor');
    }



}
