@if(!empty($dataUpdate))
  <div class="form-group" id="datoNumerico">
     <label for="num">{{$data->label}}</label>
     <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
        <i class="fas fa-mobile-alt"></i>
        </span>
        <input type="text" class="form-control" name="{{$data->nom_campo}}" id="{{$data->nom_campo}}" minlength="10" maxlength="10" value="{{ $dataUpdate[$data->nom_campo] }}" required= "required"/>
     </div>
  </div>
@else
  <div class="form-group" id="datoNumerico">
     <label for="num">{{$data->label}}</label>
     <div class="input-group">
        <span class="input-group-text" id="basic-addon1">
        <i class="fas fa-mobile-alt"></i>
        </span>
        <input type="text" class="form-control" name="{{$data->nom_campo}}" id="{{$data->nom_campo}}" minlength="10" maxlength="10" placeholder="# Celular" required= "required"/>
     </div>
  </div>
@endif
<script type = "text/javascript" >
    $('#{{$data->nom_campo}}').on('input', function() {
        /*mo permite que se escriban letgras*/
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>