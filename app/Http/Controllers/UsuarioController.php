<?php

namespace sisventas\Http\Controllers;

use Illuminate\Http\Request;

use sisventas\Http\Requests;
use sisventas\User;
use Illuminate\Support\Facades\Redirect;
use sisventas\Http\Requests\UsuarioFormRequest;
use DB;



class UsuarioController extends Controller
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
            $usuarios=DB::table('users')
            ->where('name','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }
    public function create ()
    {
       return view("seguridad.usuario.create");
    }

    public function store(UsuarioFormRequest $request)
    {
        $usuario=new User;
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->save();
        return redirect('seguridad/usuario');

    }

    public function edit($id)
    {
        return view( "seguridad.usuario.edit",["usuario"=>User::findOrFail($id)]);

    }

    public function update(UsuarioFormRequest $request,$id)
    {
        $usuario=User::findOrFail($id);
        $usuario->name=$request->get('name'); 
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->update();
       return redirect('seguridad/usuario');

    }
    
        public function destroy($id)
    {
        $usuario = DB::table('users')
        ->where('id','=',$id)->delete();
      return redirect('seguridad/usuario');
    }
}


