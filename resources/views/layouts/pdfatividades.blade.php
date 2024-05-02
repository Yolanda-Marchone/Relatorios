<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tabela Dividida em Plataformas com Descrição de Problemas</title>
<style>
body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
</style>
</head>
<body>

<div class="container">


@if($mes==1)
        <h2>Relatório Mensal de Janeiro</h2>
@endif

@if($mes==2)
        <h2>Relatório Mensal de Fevereiro</h2>
@endif
@if($mes==3)
        <h2>Relatório Mensal de Março</h2>
@endif
@if($mes==4)
        <h2>Relatório Mensal de Abril</h2>
@endif
@if($mes==5)
        <h2>Relatório Mensal de Maio</h2>
@endif
@if($mes==6)
        <h2>Relatório Mensal de Junho</h2>
@endif
@if($mes==7)
        <h2>Relatório Mensal de Julho</h2>
@endif
@if($mes==8)
        <h2>Relatório Mensal de Agosto</h2>
@endif
@if($mes==9)
        <h2>Relatório Mensal de Setembro</h2>
@endif
@if($mes==10)
        <h2>Relatório Mensal de Outubro</h2>
@endif
@if($mes==11)
        <h2>Relatório Mensal de Novembro</h2>
@endif
@if($mes==12)
        <h2>Relatório Mensal de Dezembro</h2>
@endif

<div class="table-desktop">
<table class="table app-table-hover mb-0 text-left" id="tabela">
    <thead>
        <tr>
            <th class="cell">Estado da atividade</th>
            <th class="cell">Solicitantes</th>
            <th class="cell">Atividade</th>
            <th class="cell">Detalhe da atividade</th>
            <th class="cell">Data do términio</th>
        </tr>
    </thead>


    <tbody>
    @foreach($relatorio as $relatorio)
         <tr>
             <td>{{$relatorio->estados->nome}}</td>
             <td>{{$relatorio->solicitantes->nome}}</td>
              <td>{{$relatorio->descricao}}</td>
                <td>{{$relatorio->detalhe}}</td>
                <td>{{$relatorio->data_progresso}}</td>

            </tr>
         @endforeach
    </tbody>
</table>
</div>


</body>
</html>
