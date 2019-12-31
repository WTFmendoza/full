@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"> <!-- para uso responcive boostrap --> 
		<h3>Listado de Proveedores <a href="proveedor/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('compras.proveedor.search') <!-- aqui incluimos la buqueda  -->
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
					<th>Tipo Doc</th>
					<th>Numero Doc</th>
					<th>Telefono</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>
               @foreach ($personas as $per) <!-- aqui comiensa  un bucle para que muestre las categorias -->
				<tr>
					<td>{{ $per->idpersona}}</td>
					<td>{{ $per->nombre}}</td>
					<td>{{ $per->tipo_documento}}</td>
					<td>{{ $per->num_documento}}</td>
					<td>{{ $per->telefono}}</td>
					<td>{{ $per->email}}</td>
					
					<td>
						<a href="{{URL::action('ProveedorController@edit',$per->idpersona)}}"><button class="btn btn-info">Editar</button></a>  <!-- se envian los datos a vista para poder eitar  -->  
						<a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('compras.proveedor.modal') 
				@endforeach <!-- termina el bucle -->
			</table>
		</div>
		{{$personas->render()}}
	</div>
</div>
@endsection