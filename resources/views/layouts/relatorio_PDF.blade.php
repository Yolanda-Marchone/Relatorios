<div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
                            <div class="app-card app-card-orders-table mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">



                                    <table class="table mb-0 text-left">
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


                                            <tr>

                                                    <td class="cell">{{$relatorio->descricao}}</td>
                                                    <td class="cell"><span class="truncate"></span>{{$relatorio->id_solicitante}}</td>
                                                    <td class="cell"><span class="badge bg-warning">{{$relatorio->id_categoria}}</span></td>
                                                    <td class="cell"><span class="cell-data"></span>{{$relatorio->meses->nome}}<span class="note"></span></td>
                                                    <td class="cell"><span class="truncate"></span>{{$relatorio->created_at}}</td>
                                                </tr>



                                            </tbody>

                                        </table>


                                    </div><!--//table-responsive-->
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div><!--//tab-pane-->
