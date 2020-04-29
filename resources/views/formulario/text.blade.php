@if(!empty($dataUpdate))
  <div class="form-group" id="datoTexto">
     <label for="text">{{$data['label']}}</label>
     <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
        <i class="fas fa-pencil-alt"></i>
        </span>
        <input type="text" class="form-control" id="{{$data['nom_campo']}}" name="{{$data['nom_campo']}}" value="{{ $dataUpdate[$data->nom_campo] }}" required = "required"/>
     </div>
  </div>
@else
  <div class="form-group" id="datoTexto">
     <label for="text">{{$data['label']}}</label>
     <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
        <i class="fas fa-pencil-alt"></i>
        </span>
        <input type="text" class="form-control" id="{{$data['nom_campo']}}" name="{{$data['nom_campo']}}" required = "required"/>
     </div>
  </div>
@endif
<script type = "text/javascript" >
//no permite ingrear numeros
$("#{{$data->nom_campo}}").keypress(function(){
    if (event.keyCode >45 && event.keyCode  <57){
        event.returnValue = false;
    }
});
</script>

