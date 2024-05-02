@extends('layouts.app')

@section('content')


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
               <div class="col-12 col-md-12"
    >		                <div class="app-card app-card-settings shadow-sm p-4">


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
                                    <form class="settings-form" method="POST" action="/submeter_plataformas">
                                        @csrf


                                <div class="mb-3"  >

                                            <label for="setting-input-1" class="form-label">Descrição da atividade</label>
                                            <input type="text" class="form-control" id="descricao" name="descricao"  required>

                                </div>



                                <div class="mb-3">
                                            <label for="setting-input-1" class="form-label">Selecione a categoria da atividade</label>
                                           <select type="select" class="form-select"  name="categorias" id="categorias" required>
              @foreach($categorias as $categorias)
              <option value="{{$categorias->id}}">{{$categorias->nome}}</option>
              @endforeach


          </select>
      </div>





                                            <div class="mb-3">
                                            <label for="setting-input-1" class="form-label">Selecione a plataforma</label>
                                           <select type="select" class="form-select"  name="plataformas" id="plataformas" required>

                                            @foreach($plataformas as $plataforma)
                                            <option value="{{ $plataforma->id }}">{{ $plataforma->nome }}</option>

         @endforeach


          </select>
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
@endsection
