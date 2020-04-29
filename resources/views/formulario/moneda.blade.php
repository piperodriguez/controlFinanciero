@if(!empty($dataUpdate))

<div id="datoMoneda" class="form-group" >
	<label>{{$data['label']}}</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">$</span>
		</div>
		<input type="text" class="form-control"  max="10.000.000" name="{{$data['nom_campo']}}" id="{{$data['nom_campo']}}" value="{{ $dataUpdate[$data->nom_campo] }}" placeholder="Ingrese el valor"  required>
	</div>
</div>

@else

<div id="datoMoneda" class="form-group" >
	<label>{{$data['label']}}</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">$</span>
		</div>
		<input type="text" class="form-control"  max="10.000.000" name="{{$data['nom_campo']}}" id="{{$data['nom_campo']}}" placeholder="Ingrese el valor"  required>
	</div>
</div>


@endif
<script type="text/javascript">
	$(document).ready(function (){
		$('#{{$data->nom_campo}}').on('input', function () { this.value = this.value.replace(/[^0-9]/g,''); });
		$('#{{$data->nom_campo}}').on({
		  "focus": function(event) {
			$(event.target).select();
		  },
		  "keyup": function(event) {
			$(event.target).val(function(index, value) {
			  return value.replace(/\D/g, "")
				.replace(/([0-9])([0-9]{2})$/, '$1.$2')
				.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
			});
		  }
		});
	});

</script>
