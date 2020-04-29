@if(!empty($dataUpdate))
	<div class="form-group">
		<label>{{$data->label}}</label>
		<input type="number" id="{{$data->nom_campo}}" name="{{$data['nom_campo']}}" class="form-control" value="{{ $dataUpdate[$data->nom_campo] }}" required="required">
	</div>
@else
	<div class="form-group">
		<label>{{$data->label}}</label>
		<input type="number" id="{{$data->nom_campo}}" name="{{$data['nom_campo']}}" class="form-control" required="required">
	</div>
@endif