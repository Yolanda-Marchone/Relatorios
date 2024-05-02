@extends('layouts.app')

@section('content')
@vite('resources/js/popper.js')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="app-wrapper">
	    
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    
                    <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Lista das atividades da plataforma</h1>
                        </div>
                        <div class="col-auto">
                             <div class="page-utilities">
                                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                   
                                    <div class="col-auto">
                                        
                                        <select class="form-select w-auto"  name="mes_selecionado" id="mes_selecionado" required>
                                        @foreach($relatorio as $mes)
                                              <option selected value="{{$mes->id_mes}}">{{$mes->meses->nome}}</option>
                                        @endforeach
                                        
                                        </select>
                                    </div>
                                    <div class="col-auto">						    
                                        <a class="btn app-btn-secondary" href="#">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
              <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            </svg>
                                            Descarregar
                                        </a>
                                    </div>
                                </div><!--//row-->
                            </div><!--//table-utilities-->
                        </div><!--//col-auto-->
                    </div><!--//row-->
                   
                    
                    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                        <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Todos</a>
                        
                    </nav>
                    
                    
                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                    
                                        <table class="table app-table-hover mb-0 text-left" id="tabela">
                                            <thead>
                                                <tr>
                                                    <th class="cell">Decrição da atividade</th>
                                                    <th class="cell">Plataforma</th>
                                                    <th class="cell">Categoria</th>
                                                    <th class="cell">Mês</th>
                                                    <th class="cell">Data</th>
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            @foreach($relatorio as $relatorio)

                                            <tr mes="{{ $relatorio->id_mes }}">
                                     
    
                                                    <td class="cell">{{$relatorio->descricao}}</td>
                                                    <td class="cell"><span class="truncate"></span>{{$relatorio->plataformas->nome}}</td>
                                                    <td class="cell"><span class="badge bg-warning">{{$relatorio->categorias->nome}}</span></td>
                                                    <td class="cell"><span class="cell-data"></span>{{$relatorio->meses->nome}}<span class="note"></span></td>
                                                    <td class="cell"><span class="truncate"></span>{{$relatorio->created_at}}</td>
                                               
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
                    
                    
                       <a class="btn app-btn-primary" href="{{ url('/plataforma') }}" >Adicionar atividade</a>
                </div><!--//container-fluid-->
    
            </div><!--//app-content-->
            
     
            
        </div><!--//app-wrapper-->    					
    
    </div>
</div>

           
@endsection

