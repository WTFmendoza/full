{!! Form::open(array('url'=>'compras/proveedor','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}  <!-- formulario de tipo busqueda  -->
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button> <!-- boton de busqueda   --> 
		</span>
	</div>
</div>

{{Form::close()}}