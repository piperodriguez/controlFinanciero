@if(!empty($dataUpdate))
	<div class="form-group" id="datofecha">
		<label for="fecha">{{$data['label']}}</label>
		<div class="input-group">
			<span class="input-group-text" id="basic-addon1">
				<i class="far fa-calendar-alt"></i>
			</span>
			<input type="text" id="{{$data['nom_campo']}}" name="{{$data['nom_campo']}}" class="form-control" placeholder="Seleccione la Fecha"  value="{{ $dataUpdate[$data->nom_campo] }}" pattern="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$"  required="required">
		</div>
	</div>
@else
	<div class="form-group" id="datofecha">
		<label for="fecha">{{$data['label']}}</label>
		<div class="input-group">
			<span class="input-group-text" id="basic-addon1">
				<i class="far fa-calendar-alt"></i>
			</span>
			<input type="text" id="{{$data['nom_campo']}}" name="{{$data['nom_campo']}}" class="form-control" placeholder="Seleccione la Fecha"  pattern="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$"  required="required">
		</div>
	</div>
@endif


<script type="text/javascript">
	$.datepicker.regional['es'] = {
	    closeText: 'Cerrar',
	    prevText: '< Ant',
	    nextText: 'Sig >',
	    currentText: 'Hoy',
	    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
	    dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado'],
	    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi�', 'Juv', 'Vie', 'S�b'],
	    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S�'],
	    weekHeader: 'Sm',
	    dateFormat: 'dd/mm/yy',
	    firstDay: 1,
	    isRTL: false,
	    showMonthAfterYear: false,
	    yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	/*Asignacion de datepicker de jquery UI*/
	$("#{{ $data->nom_campo }}").datepicker({
		//showAnim: 'slideDown'
		showAnim: "slide"
	});
</script>
