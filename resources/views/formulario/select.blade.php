@if ($data->query_campo != null)
	@if(!empty($dataUpdate))
		<input type="hidden" id="validarAjax"  value="{{ $dataUpdate[$data->nom_campo] }}">
		<div class="form-group" id="datoSeleccion">
			<label for="seleccion">{{$data->label}}</label>
			<div class="input-group">
				<span class="input-group-text" id="basic-addon1">
					<i class="fas fa-hand-pointer"></i>
				</span>
				<select class="form-control" name="{{ $data->nom_campo }}" id="{{ $data->nom_campo }}" required="required">
				</select>
			</div>
		</div>
	@else
		<div class="form-group" id="datoSeleccion">
			<label for="seleccion">{{$data->label}}</label>
			<div class="input-group">
				<span class="input-group-text" id="basic-addon1">
					<i class="fas fa-hand-pointer"></i>
				</span>
				<select class="form-control" name="{{ $data->nom_campo }}" id="{{ $data->nom_campo }}" required="required">
				</select>
			</div>
		</div>
	@endif
<script type="text/javascript">
	$(document).ready(function(){
		var validar = $("#validarAjax").val();
		if (validar) {
			$.ajax({
				type: "POST",
				url: "{{ route('consulta.select') }}",
				data: {
					"_token" : "{{ csrf_token() }}",
					"querySelect" : "{{ $data->query_campo." where ".$data->getKeyName()." != ".$dataUpdate[$data->nom_campo] }}",
					"querySelectOne" : "{{ $data->query_campo." where ".$data->getKeyName(). " = ".$dataUpdate[$data->nom_campo] }}",
					"id" : validar
			},
			success: function(data){

				var option1;
				data.resultIndividual.forEach(resultIndividual => {
					option1 += "<option selected value="+ resultIndividual.id +">"+resultIndividual.text+"</option>";
				})
				var opciones;
				data.result.forEach(result => {
					opciones +=  "<option value="+ result.id +"> "+ result.text +"</option>"
				})
				var resultado;
				prueba = option1+opciones;
				$("#{{ $data->nom_campo }}").html(prueba);
			}
			});

		}else{
			$.ajax({
				type: "POST",
				url: "{{ route('consulta.select') }}",
				data: {
					"_token" : "{{ csrf_token() }}",
					"querySelect" : "{{ $data->query_campo }}"
			},
			success: function(data){
				var valor = "<option selected value=''>Seleccione una opci�n </option>"
				data.result.forEach(result => {
					valor +=
					"<option value=" + result.id + ">"+
					result.text + "</option>";
				})
				$("#{{ $data->nom_campo }}").html(valor);
			}
			});
		}
	});
</script>
@endif

@if ($data->listado != null)
	@if(!empty($dataUpdate))
		<div class="form-group" id="datoSeleccion">
			<label for="seleccion">{{$data->label}}</label>
			<div class="input-group">
				<span class="input-group-text" id="basic-addon1">
					<i class="fas fa-hand-pointer"></i>
				</span>
				@php $datos = explode("|", $dataUpdate[$data->nom_campo]); @endphp
				<select class="form-control" name="{{ $data->nom_campo }}" id="selector" required="required">
					<option value="{{$dataUpdate[$data->nom_campo]}}" selected="">{{$datos[1]}}</option>
					@php $valoresSeparados = explode("|", $data->listado); @endphp
						@foreach ($valoresSeparados as $datos)
							@php $separador = explode(";", $datos) @endphp
							@if (isset($separador[0]) && isset($separador[1]))
							<option value="{{ $separador[0] }}|{{ $separador[1]}}">{{ $separador[1]}}</option>
							@endif
						@endforeach
				</select>
			</div>
		</div>
	@else
		<div class="form-group" id="datoSeleccion">
			<label for="seleccion">{{$data->label}}</label>
			<div class="input-group">
				<span class="input-group-text" id="basic-addon1">
					<i class="fas fa-hand-pointer"></i>
				</span>
				<select class="form-control" name="{{ $data->nom_campo }}" id="selector" required="required">
					<option value="">Seleccione</option>
					@php $valoresSeparados = explode("|", $data->listado); @endphp
						@foreach ($valoresSeparados as $datos)
							@php $separador = explode(";", $datos) @endphp
							@if (isset($separador[0]) && isset($separador[1]))
							<option value="{{ $separador[0] }}|{{ $separador[1]}}">{{ $separador[1]}}</option>
							@endif
						@endforeach
				</select>
			</div>
		</div>
	@endif
@endif
