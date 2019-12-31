@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"> <!-- para uso responcive boostrap --> 
		<h3>Listado de Categorías <a href="categoria/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.categoria.search') <!-- aqui incluimos la buqueda  -->
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
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
               @foreach ($categorias as $cat) <!-- aqui comiensa  un bucle para que muestre las categorias -->
				<tr>
					<td>{{ $cat->idcategoria}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->descripcion}}</td>
					<td>
						<a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}"><button class="btn btn-info">Editar</button></a>  <!-- se envian los datos a vista para poder eitar  -->  
						<a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.categoria.modal') 
				@endforeach <!-- termina el bucle -->
			</table>
		</div>
		{{$categorias->render()}}
	</div>
</div>
@endsection