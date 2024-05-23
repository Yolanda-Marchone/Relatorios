@extends('layouts.app')

@section('content')


<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Visualizar relatório mensal</h1>
                        </div>
                </div>
                <hr class="mb-4">
                <div class="col-auto">
                             <div class="page-utilities">
                                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                    <div class="col-auto">


                                    </div><!--//col-->

                                    <div class="col-auto">
                                    <select class="form-select w-auto"  name="mes_selecionado" id="mes_selecionado" required>
                                        @foreach($mes as $mes)


                                              <option selected value="{{$mes->id}}">{{$mes->nome}}</option>

                                        @endforeach

                                        </select>
                                    </div>



                                    <div class="col-auto">
                                    <button type="submit" class="btn app-btn-primary" >Procurar</button>
                                    </div>


                                </div><!--//row-->
                            </div><!--//table-utilities-->
                        </div><!--//col-auto-->
                <div class="container">
    <div class="table-desktop">
        <div class="table-row">
            <div class="table-cell">Plataforma</div>
            <div class="table-cell">Desempenho</div>
            <div class="table-cell">Disponibilidade</div>
            <div class="table-cell">Problemas relatados</div>
        </div>
    </div>
                </div>


                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
