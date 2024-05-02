@extends('layouts.app')

@section('content')




<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="app-wrapper">

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Lista das atividades da plataforma</h1>
                        </div>
                        <form id="pdfForm" action="/pdf" method="GET">
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                                <div class="col-auto">

                                    <div class="row">
                                        <div class="col-auto">
                                            <select class="form-select" name="mes_selecionado" id="mes_selecionado" required>
                                                @foreach($mes as $mes)
                                                    <option value="{{$mes->id_mes}}">{{$mes->meses->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <select class="form-select" name="plataforma_selecionada" id="plataforma_selecionada" required>
                                                @foreach($plataforma as $plataforma)
                                                    <option value="{{$plataforma->id_plataforma}}">{{$plataforma->plataformas->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>




                                        <div class="col-auto">
                                    <button type="submit" class="btn app-btn-primary" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
</svg></button>
                                    </div>
                                </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
            </form>
                </div>



                    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                        <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Todos</a>

                    </nav>

@if(session('success'))
    <div id="popupSuccess" class="overlay">
        <div class="popup-content">
            <p>{{ session('success') }}</p>
        </div>
    </div>
@endif

@if(session('delete'))
    <div id="popupdelete" class="overlay">
        <div class="popup-content">
            <p>{{ session('delete') }}</p>
        </div>
    </div>
@endif
                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">

                                        <table class="table app-table-hover mb-0 text-left" id="tabela">
                                            <thead>
                                                <tr>
                                                    <th class="cell">Problemas relatados</th>
                                                    <th class="cell">Plataforma</th>
                                                    <th class="cell">Categoria</th>
                                                    <th class="cell">Mês</th>
                                                    <th class="cell">Data</th>


                                                </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($relatorio as $relatorio)

                                            <tr data-mes="{{ $relatorio->id_mes }}" data-plataforma="{{ $relatorio->id_plataforma }}" >


                                                    <td class="cell">{{$relatorio->descricao}}</td>
                                                    <td class="cell"><span class="truncate"></span>{{$relatorio->plataformas->nome}}</td>
                                                    <td class="cell"><span class="badge bg-success">{{$relatorio->categorias->nome}}</span></td>
                                                    <td class="cell"><span class="cell-data"></span>{{$relatorio->meses->nome}}<span class="note"></span></td>
                                                    <td class="cell"><span class="truncate"></span>{{$relatorio->created_at}}</td>
                                                    <td class="cell"><a class="btn btn-warning" href="{{ url('/editar_plataforma', ['id' => $relatorio->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></a></td>
                                                    <form method="POST" action="/apagar_plataforma/{{$relatorio->id}}">
        @csrf
        @method('DELETE')
        <td class="cell"><button type="submit" class="btn btn-danger"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button></td>

    </form>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div><!--//table-responsive-->

                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                            <nav class="app-pagination">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Antes</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Depois</a>
                                    </li>
                                </ul>
                            </nav><!--//app-pagination-->

                        </div><!--//tab-pane-->





                    </div><!--//tab-content-->
<div>

                       <a class="btn app-btn-primary" href="{{ url('/plataforma') }}" >Adicionar atividade</a>
                </div><!--//container-fluid-->

            </div><!--//app-content-->



        </div><!--//app-wrapper-->

    </div>
</div>
</div>


<script>
document.getElementById('mes_selecionado').addEventListener('change', function() {
    filtrarLinhas();
});

document.getElementById('plataforma_selecionada').addEventListener('change', function() {
    filtrarLinhas();
});

function filtrarLinhas() {
    const mesSelecionado = document.getElementById('mes_selecionado').value;
    const plataformaSelecionada = document.getElementById('plataforma_selecionada').value;
    const linhasTabela = document.querySelectorAll('#tabela tbody tr');

    linhasTabela.forEach(linha => {
        const mesRelatorio = linha.getAttribute('data-mes');
        const plataformaRelatorio = linha.getAttribute('data-plataforma');
        if ((mesSelecionado === '' || mesSelecionado === mesRelatorio) &&
            (plataformaSelecionada === '' || plataformaSelecionada === plataformaRelatorio)) {
            linha.style.display = 'table-row';
        } else {
            linha.style.display = 'none';
        }
    });
}

function showSuccessPopup() {
        document.getElementById("popupSuccess").style.display = "flex"; // Mostra o pop-up
        setTimeout(function() {
            document.getElementById("popupSuccess").style.display = "none"; // Esconde o pop-up após alguns segundos
        }, 3000); // Tempo em milissegundos (3 segundos)
    }

    // Adiciona um listener para o evento 'submit' do formulário
    document.getElementById('settings-form').addEventListener('submit', function(event) {
        showSuccessPopup(); // Exibe o pop-up de sucesso
    });

    function showSuccessPopup() {
        document.getElementById("popupdelete").style.display = "flex"; // Mostra o pop-up
        setTimeout(function() {
            document.getElementById("popupdelete").style.display = "none"; // Esconde o pop-up após alguns segundos
        }, 3000); // Tempo em milissegundos (3 segundos)
    }

    // Adiciona um listener para o evento 'submit' do formulário
    document.getElementById('settings-form').addEventListener('submit', function(event) {
        showSuccessPopup(); // Exibe o pop-up de sucesso
    });


    </script>



@endsection
