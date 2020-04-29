@if(!empty($dataUpdate))
	<div class="form-group form-check">
		<label class="form-check-label">
	        <input class="form-check-input" type="checkbox" id="{{$data->nom_campo}}" name="{{$data->nom_campo}}" value="{{ $dataUpdate[$data->nom_campo] }}" required ="required"> {{$data->label}}
		</label>
	</div>
@else
	<div class="form-group form-check">
		<label class="form-check-label">
	        <input class="form-check-input" type="checkbox" name="{{$data->nom_campo}}" required = "required"> {{$data->label}}
		</label>
	</div>
@endif
<script>
$(document).ready(function(){
	var value = $("#{{$data->nom_campo}}").val();
	if (value == 1) {
		$("#{{$data->nom_campo}}").prop("checked", true);
		//$("#{{$data->nom_campo}}").attr('disabled', true);

	}else{
		$("#{{$data->nom_campo}}").prop("checked", false);
	}
});
</script>