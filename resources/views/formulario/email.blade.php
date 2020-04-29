@if(!empty($dataUpdate))
	<div class="form-group" id="datoEmail">
		<label class="col-sm-6 control-label" for="{{$data->nom_campo}}">{{$data->label}}</label>
		<div class="input-group">
			<span class="input-group-text" id="basic-addon1">
				<i class="far fa-envelope"></i>
			</span>
			<input type="email" id="correo" name="{{$data->nom_campo}}" class="form-control" placeholder="Email" value="{{ $dataUpdate[$data->nom_campo] }}"  required ="required"/>
		</div>
		<br>
	</div>
@else
	<div class="form-group" id="datoEmail">
		<label class="col-sm-6 control-label" for="{{$data->nom_campo}}">{{$data->label}}</label>
		<div class="input-group">
			<span class="input-group-text" id="basic-addon1">
				<i class="far fa-envelope"></i>
			</span>
			<input type="email" id="correo" name="{{$data->nom_campo}}" class="form-control" placeholder="Email" required ="required"/>
		</div>
		<br>
	</div>
@endif