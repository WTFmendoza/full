@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"> <!-- para uso responcive boostrap --> 
		<h3>Listado de usuarios <a href="usuario/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('seguridad.usuario.search') <!-- aqui incluimos la buqueda  -->
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover"> <!-- esto es para que sea responcivo la tabla --> 
				<thead>
                <!-- aqui añadimos celdas dela tabla -->
					<th>Id</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>
               @foreach ($usuarios as $usu) 
				<tr>
					<td>{{ $usu->id}}</td>
					<td>{{ $usu->name}}</td>
					<td>{{ $usu->email}}</td>
					<td>
						<a href="{{URL::action('UsuarioController@edit',$usu->id)}}"><button class="btn btn-info">Editar</button></a>  <!-- se envian los datos a vista para poder eitar  -->  
						<a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('seguridad.usuario.modal') 
				@endforeach <!-- termina el bucle -->
			</table>
		</div>
		{{$usuarios->render()}}
	</div>
</div>
@endsection