@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Proveedor: {{ $persona->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

			{!!Form::model($persona,['method'=>'PATCH','route'=>['proveedor.update',$persona->idpersona]])!!}<!-- la ruta de update solo proveedor.update   -->
			{{Form::token()}}
			
			<div class="row"> <!-- tablas de articulos -->
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre...">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="direccion">Direccion</label>
						<input type="text" name="direccion" value="{{$persona->direccion}}" class="form-control" placeholder="Direccion..">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Documento</label>
						<select name="tipo_documento" class="form-control">

								@if($persona->tipo_documento=='DNI')
					<option value="DNI"selected>DNI</option>
					<option value="RUC">RUC</option>
					<option value="PAS">PAS</option>

					@elseif ($persona->tipo_documento=='RUC')
					<option value="DNI">DNI</option>
					<option value="RUC"selected>RUC</option>
					<option value="PAS">PAS</option>

					@else
					<option value="DNI">DNI</option>
					<option value="RUC">RUC</option>
					<option value="PAS"selected>PAS</option>
					@endif
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="num_documento">Numero de Documento</label>
						<input type="text" name="num_documento" value="{{$persona->num_documento}}" class="form-control" placeholder="Numero de Documento...">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="telefono">Telefono</label>
						<input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="Telefono...">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email"  value="{{$persona->email}}" class="form-control" placeholder="Email...">
					</div>
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Guardar</button>
						<button class="btn btn-danger" type="reset">Cancelar</button>
					</div>
				</div>
		
			</div>
							
					
			{!!Form::close()!!}		
            
		
@endsection