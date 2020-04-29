@section('apertura')
	@if (empty($id))
		<form method="POST" id="{{ $id_formulario }}" name="{{ $id_formulario }}"  action="{{ route('formulario.save') }}">
	    {!! csrf_field() !!}
	@else
		<form action="{{ route('formulario.update', ['id' => $id]) }}" id="{{ $id_formulario }}" name="{{ $id_formulario }}" method="POST">
		@method('put')
		{!! csrf_field() !!}
		<input type="hidden" name="nameTable" value="{{$nomTabla}}">

	@endif

		<input type="hidden" name="nom_programa" value="{{$id_formulario}}">
@endsection
@section('cierre')
	@if (empty($id))
		<button onclick="guardarFormulario('{{$id_formulario}}')"  class="btn btn-dark">Guardar</button>
	@else
		<button onclick="guardarFormulario('{{$id_formulario}}')"  class="btn btn-dark">Actualizar</button>
	@endif
	</form>
@endsection
