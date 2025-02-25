@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"> <!-- para uso responcive boostrap --> 
		<h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{url('reporteventas')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('ventas/venta.search') <!-- aqui incluimos la buqueda  -->
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover"> <!-- esto es para que sea responcivo la tabla --> 
				<thead>
                <!-- aqui añadimos celdas dela tabla 
					<th>Id</th>-->
					<th>Fecha</th>
					<th>cliente</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ventas as $ven) <!-- tabla de ventas -->
				<tr>
					<td>{{ $ven->fecha_hora}}</td>
					<td>{{ $ven->nombre}}</td>
					<td>{{ $ven->tipo_comprobante.' : '.$ven->serie_comprobante.' - '.$ven->num_comprobante}}</td>
					<td>{{ $ven->impuesto}}</td>
					<td>{{ $ven->total_venta}}</td>
					<td>{{ $ven->estado}}</td>
					
					
					<td>
						<a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">Detalles</button></a>  <!-- se envian los datos a vista para poder eitar  -->  
						<a target="_blank" href="{{URL::action('VentaController@reportec',$ven->idventa)}}"><button class="btn btn-info">Reporte</button></a>
						<a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('ventas.venta.modal') 
				@endforeach <!-- termina el bucle -->
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>
@endsection