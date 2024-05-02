<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Relatórios</title>

<style>
    /* Estilos gerais */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f1f1f1;
    }
    .container {
        max-width: 900px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    /* Estilos para desktop */
    .table-desktop {
        display: table;
        width: 100%;
    }
    .table-row {
        display: table-row;
    }
    .table-cell {
        display: table-cell;
        padding: 10px;
        border: 1px solid #ddd;
    }
    /* Estilos para mobile */
    .table-mobile {
        display: none;
    }
    .table-mobile-header {
        display: block;
        font-weight: bold;
    }
    @media only screen and (max-width: 600px) {
        .table-desktop {
            display: none;
        }
        .table-mobile {
            display: block;
            width: 100%;
        }
        .table-cell {
            display: block;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #ddd;
        }
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
        <div class="table-row">
            <div class="table-cell">Plataforma</div>
            <div class="table-cell">Desempenho</div>
            <div class="table-cell">Disponibilidade</div>
            <div class="table-cell">Problemas relatados</div>
        </div>

        @foreach($relatorio as $relatorio)

        <div class="table-row">

            <div class="table-cell">{{$relatorio->plataformas->nome}}</div>

            @if($relatorio->id_plataforma==1)
            @if($percesrura < 49)
    <div class="table-cell">Baixo</div>
@elseif($percesrura >= 49 && $percesrura <= 95)
    <div class="table-cell badge bg-success">Bom</div>
@else
    <div class="table-cell">Alto</div>
@endif

            @endif

            @if($relatorio->id_plataforma==2)
            @if($percbiblioteca < 49)
    <div class="table-cell">Baixo</div>
@elseif($percbiblioteca >= 49 && $percbiblioteca <= 95)
    <div class="table-cell badge bg-success">Bom</div>
@else
    <div class="table-cell">Alto</div>
@endif

            @endif

            @if($relatorio->id_plataforma==3)
            @if($percrevista < 49)
    <div class="table-cell">Baixo</div>
@elseif($percrevista >= 49 && $percrevista <= 95)
    <div class="table-cell badge bg-success">Bom</div>
@else
    <div class="table-cell">Alto</div>
@endif

            @endif
            @if($relatorio->id_plataforma==4)
            @if($percemail < 49)
    <div class="table-cell">Baixo</div>
@elseif($percemail >= 49 && $percemail <= 95)
    <div class="table-cell badge bg-success">Bom</div>
@else
    <div class="table-cell">Alto</div>
@endif

            @endif

            @if($relatorio->id_plataforma==5)
            @if($percmoodle < 49)
    <div class="table-cell">Baixo</div>
@elseif($percmoodle >= 49 && $percmoodle <= 95)
    <div class="table-cell badge bg-success">Bom</div>
@else
    <div class="table-cell">Alto</div>
@endif

            @endif


            @if($relatorio->id_plataforma==1)
            <div class="table-cell">{{$percmoodle}} %</div>
            @endif
            @if($relatorio->id_plataforma==2)
            <div class="table-cell">{{$percmoodle}} %</div>
            @endif
            @if($relatorio->id_plataforma==3)
            <div class="table-cell">{{$percmoodle}} %</div>
            @endif
            @if($relatorio->id_plataforma==4)
            <div class="table-cell">{{$percmoodle}} %</div>
            @endif
            @if($relatorio->id_plataforma==5)
            <div class="table-cell">{{$percmoodle}} %</div>
            @endif
            <div class="table-cell">

            @if($relatorio->id_plataforma==1)
                <ul>
                    @foreach($esura as $esura)
                    <li>{{$esura->descricao}}</li>
                    @endforeach
                </ul>
                @endif

                @if($relatorio->id_plataforma==2)
                <ul>
                    @foreach($biblioteca as $biblioteca)
                    <li>{{$biblioteca->descricao}}</li>
                    @endforeach
                </ul>
                @endif

                @if($relatorio->id_plataforma==3)
                <ul>
                    @foreach($revista as $revista)
                    <li>{{$revista->descricao}}</li>
                    @endforeach
                </ul>
                @endif

                @if($relatorio->id_plataforma==4)
                <ul>
                    @foreach($email as $email)
                    <li>{{$email->descricao}}</li>
                    @endforeach
                </ul>
                @endif

               @if($relatorio->id_plataforma==5)
                <ul>
                    @foreach($moodle as $moodle)
                    <li>{{$moodle->descricao}}</li>
                    @endforeach
                </ul>
                @endif

            </div>
        </div>

        @endforeach

    </div>


</div>

</body>
</html>
