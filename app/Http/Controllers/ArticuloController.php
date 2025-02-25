<?php

namespace sisventas\Http\Controllers;

use Illuminate\Http\Request;
use sisventas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisventas\Http\Requests\ArticuloFormRequest;
use sisventas\Articulo;
use DB;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(Request $request) // Funcion de busqueda //
    {
        if ($request) 
        {
            $query=trim($request->get('searchText'));
            $articulos=DB::table('articulo as a') // relacionando con la bd y dandole el alias a  //
            ->join('categoria as c','a.idcategoria','=','c.idcategoria') // ralacionando las categoria y articulo  //
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->where ('a.estado','=','Activo')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')//
            ->where ('a.estado','=','Activo')
            ->orderBy('a.idarticulo','desc') // orden decrecien //
            ->paginate(7);
                        
            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }
    public function create() // funcion de crear//
    {
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.create",["categorias"=>$categorias]);
    }
    public function store (ArticuloFormRequest $request)
    {
        $articulo=new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado='Activo';
        
        if(Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }
        $articulo->save();
        return Redirect::to('almacen/articulo');

    }
    public function show($id) // funcion de mostrar //
    {
        return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }
    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get(); // solo seleccionamos las tegorias activas =1//
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }
    public function update(ArticuloFormRequest $request,$id) //  funcion deactualizar //
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
             
        if(Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }
        
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
    public function destroy($id) // funcion de borrar ojo solo cambia a inactivo y lo hace no visible en la tabla//
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
    public function reporte(){
        //Obtenemos los registros
        $registros=DB::table('articulo as a')
           ->join('categoria as c','a.idcategoria','=','c.idcategoria')
           ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
           ->orderBy('a.nombre','asc')
           ->get();

        $pdf = new Fpdf();
        $pdf::AddPage();
        $pdf::SetTextColor(35,56,113);
        $pdf::SetFont('Arial','B',11);
        $pdf::Cell(0,10,utf8_decode("Listado Artículos"),0,"","C");
        $pdf::Ln();
        $pdf::Ln();
        $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
        $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
        $pdf::SetFont('Arial','B',10); 
        //El ancho de las columnas debe de sumar promedio 190        
        $pdf::cell(30,8,utf8_decode("Código"),1,"","L",true);
        $pdf::cell(80,8,utf8_decode("Nombre"),1,"","L",true);
        $pdf::cell(65,8,utf8_decode("Categoría"),1,"","L",true);
        $pdf::cell(15,8,utf8_decode("Stock"),1,"","L",true);
        
        $pdf::Ln();
        $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
        $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
        $pdf::SetFont("Arial","",9);
        
        foreach ($registros as $reg)
        {
           $pdf::cell(30,6,utf8_decode($reg->codigo),1,"","L",true);
           $pdf::cell(80,6,utf8_decode($reg->nombre),1,"","L",true);
           $pdf::cell(65,6,utf8_decode($reg->categoria),1,"","L",true);
           $pdf::cell(15,6,utf8_decode($reg->stock),1,"","L",true);
           $pdf::Ln(); 
        }

        $pdf::Output();
        exit;
   }

}
