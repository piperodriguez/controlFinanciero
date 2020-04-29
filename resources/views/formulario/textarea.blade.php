@if(!empty($dataUpdate))
	<div class="form-group" id="datoTextArea">
		<label for="textolargo">{{$data->label}}</label>
		<div class="input-group">
			<span class="input-group-text" id="basic-addon1">
				<i class="fas fa-align-justify"></i>
			</span>
			<textarea class="form-control" rows="5" name="{{$data->nom_campo}}" id="textolargo" value="" required>{{ $dataUpdate[$data->nom_campo] }}</textarea>
		</div>
	</div>
@else
	<div class="form-group" id="datoTextArea">
		<label for="textolargo">{{$data->label}}</label>
		<div class="input-group">
			<span class="input-group-text" id="basic-addon1">
				<i class="fas fa-align-justify"></i>
			</span>
			<textarea class="form-control" rows="5" name="{{$data->nom_campo}}" id="textolargo" placeholder="Ingrese un texto" required></textarea>
		</div>
	</div>
@endif

