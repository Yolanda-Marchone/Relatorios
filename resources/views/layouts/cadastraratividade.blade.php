@extends('layouts.app')

@section('content')

@vite('resources/js/popper.js')

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">


                <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <h1 class="app-page-title">Introduza a atividade</h1>
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
               <div class="col-12 col-md-12">
                 <div class="app-card app-card-settings shadow-sm p-4">


                                <div class="app-card-body">

                                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                                    <form class="settings-form" method="POST" action="/submeter_atividades">
                                        @csrf


                                <div class="mb-3"  >

                                            <label for="setting-input-1" class="form-label">Atividade</label>
                                            <input type="text" class="form-control" id="descricao" name="descricao"  required>

                                </div>

                                <div class="mb-3"  >

                                            <label for="setting-input-1" class="form-label">Detalhe da atividade</label>
                                            <input type="text" class="form-control" id="detalhe" name="detalhe"  required>

                                </div>



                                <div class="mb-3">
                                            <label for="setting-input-1" class="form-label">Selecione o solicitante</label>
                                           <select type="select" class="form-select"  name="solicitantes" id="solicitantes" required>
              @foreach($solicitantes as $solicitantes)
              <option value="{{$solicitantes->id}}">{{$solicitantes->nome}}</option>
              @endforeach


          </select>
      </div>



                                            <div class="mb-3">
                                            <label for="setting-input-1" class="form-label">Selecione o estado</label>
                                           <select type="select" class="form-select"  name="estados" id="estados" required>

                                            @foreach($estados as $estados)
                                            <option value="{{ $estados->id }}">{{ $estados->nome }}</option>

         @endforeach


          </select>
      </div>

      <div class="mb-3" id="divData" style="display: none;">

                                             <label for="setting-input-1" class="form-label">Introduza a data</label>
                                             <input type="date" class="form-control" id="data_progresso" name="data_progresso">

                                 </div>


      <div class="mb-3">
                                            <label for="setting-input-1" class="form-label">Selecione o mês</label>
                                           <select type="select" class="form-select"  name="mes" id="mes" required>

                                            @foreach($mes as $mes)
                                            <option value="{{ $mes->id }}">{{ $mes->nome }}</option>

         @endforeach


          </select>
      </div>


      <div class="mb-3"  >

                                             <label for="setting-input-1" class="form-label">Indique o ano</label>
                                             <input type="number" class="form-control" id="ano" name="ano" value="" required>

                                 </div>






                                        <button type="submit" class="btn app-btn-primary" >Submeter</button>
                                    </form>
                                </div><!--//app-card-body-->

                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <hr class="my-4">

                </div><!--//container-fluid-->
            </div>






                </div><!--//container-fluid-->
            </div><!--//app-content-->


        </div><!--//app-wrapper-->

    </div>
</div>

<script>
document.getElementById('estados').addEventListener('change', function() {
    const estadoSelecionado = this.value;

    if (estadoSelecionado === '3') {
        document.getElementById('divData').style.display = 'block';
    } else {
        document.getElementById('divData').style.display = 'none';
    }
});


</script>


@endsection
