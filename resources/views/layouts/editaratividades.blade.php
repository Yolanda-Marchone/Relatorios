@extends('layouts.app')

@section('content')




<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">


                    <h1 class="app-page-title">Editar Atividade</h1>
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



                                    <form class="settings-form" method="POST" action="/salvar_atividades/{{$atividade->id}}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">

                                            <label for="descricao" class="form-label">Atividade</label>
                                            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $atividade->descricao }}" required>

                                        </div>

                                        <div class="mb-3">

                                            <label for="detalhe" class="form-label">Detalhe da atividade</label>
                                            <input type="text" class="form-control" id="detalhe" name="detalhe" value="{{ $atividade->detalhe }}" required>

                                        </div>

                                        <div class="mb-3">
                                            <label for="solicitantes" class="form-label">Selecione o solicitante</label>
                                            <select class="form-select" id="solicitantes" name="solicitantes" required>
                                                @foreach($solicitantes as $solicitante)
                                                <option value="{{ $solicitante->id }}" {{ $atividade->id_solicitante == $solicitante->id ? 'selected' : '' }}>{{ $solicitante->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="estados" class="form-label">Selecione o estado</label>
                                            <select class="form-select" id="estados" name="estados" required>
                                                @foreach($estados as $estado)
                                                <option value="{{ $estado->id }}" {{ $atividade->id_estado == $estado->id ? 'selected' : '' }}>{{ $estado->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3" id="divData" style="display: {{ isset($atividade->id_estado) && $atividade->id_estado == 3 ? 'block' : 'none' }}">

                                            <label for="data_progresso" class="form-label">Introduza a data</label>
                                            <input type="date" class="form-control" id="data_progresso" name="data_progresso" value="{{ $atividade->data_progresso }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="mes" class="form-label">Selecione o mês</label>
                                            <select class="form-select" id="mes" name="mes" required>
                                                @foreach($mes as $m)
                                                <option value="{{ $m->id }}" {{ $atividade->id_mes == $m->id ? 'selected' : '' }}>{{ $m->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="ano" class="form-label">Indique o ano</label>
                                            <input type="number" class="form-control" id="ano" name="ano" value="{{ $atividade->ano }}" required>
                                        </div>

                                        <button type="submit" class="btn app-btn-primary">Salvar</button>
                                        <a href="{{ url('/lista_atividades') }}"class="btn btn-secondary">Cancelar</a>
                                    </form>
                                </div><!--//app-card-body-->

                            </div><!--//app-card-->
                        </div>
                    </div><!--//row-->
                    <hr class="my-4">

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
