<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Atividades;
use App\Models\Estados;
use App\Models\Mes;
use App\Models\Rela_atividade;
use App\Models\Rela_atividades;
use App\Models\Relatorio_mensal;
use App\Models\Solicitantes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

class AtividadesController extends Controller
{
    public function exibir_dados()

    {
        $estados = Estados::all();
        $solicitantes= Solicitantes:: all();
        $mes= Mes:: all();

        return view('layouts/cadastraratividade', ['estados' => $estados, 'solicitantes'=>$solicitantes, 'mes'=>$mes]);
    }

    public function ()

    {
        $estados = Estados::all();
        $solicitantes= Solicitantes:: all();
        $mes= Mes:: all();

        return view('layouts/cadastraratividade', ['estados' => $estados, 'solicitantes'=>$solicitantes, 'mes'=>$mes]);
    }

    public function exibir_dados_atividade()

    {
      $relatorio= Atividades:: all();
      $mes = Atividades::select('id_mes')->distinct()->get();

        return view('layouts/atividades', ['relatorio'=>$relatorio, 'mes'=>$mes]);
    }


    public function criar_relatorio_atividade(Request $request)
    {
        $user1 = new Atividades();
        $user1->descricao= $request->input('descricao');
        $user1->detalhe= $request->input('detalhe');
        $user1->id_solicitante = $request->input('solicitantes');
        $user1->id_estado = $request->input('estados');
        $user1->data_progresso= $request->input('data_progresso');
        $user1->id_mes=$request->input('mes');
        $user1->ano=$request->input('ano');

        $request->validate([
            'ano' => 'required|integer|min:2024',
        ], [
            'ano.min' => 'O ano deve ser igual ou superior a 2024.',
        ]);






        $user1->id_usuario = Auth::id();

        $user1->save();



        return redirect('/lista_atividades');
    }


    public function editarAtividade($id)
{
    // Busca a atividade pelo ID
    $atividade = Atividades::find($id);

    // Verifica se a atividade foi encontrada
    if (!$atividade) {
        // Retorna uma resposta para o caso de atividade não encontrada
        return response()->json(['message' => 'Atividade não encontrada.'], 404);
    }

    // Carrega os solicitantes e estados para exibição nos campos de seleção
    $solicitantes = Solicitantes::all();
    $estados = Estados::all();
    $mes = Mes::all();


    return view('layouts/editaratividades', ['estados' => $estados, 'solicitantes'=>$solicitantes, 'mes'=>$mes, 'atividade'=>$atividade]);}


    public function editar_atividade(Request $request, $id)
    {
        $atividade = Atividades::findOrFail($id);
        $atividade->descricao = $request->input('descricao');
        $atividade->detalhe = $request->input('detalhe');
        $atividade->id_solicitante = $request->input('solicitantes');
        $atividade->id_estado = $request->input('estados');
        $atividade->data_progresso = $request->input('data_progresso');
        $atividade->id_mes = $request->input('mes');
        $atividade->ano = $request->input('ano');

        $request->validate([
            'ano' => 'required|integer|min:2024',
        ], [
            'ano.min' => 'O ano deve ser igual ou superior a 2024.',
        ]);

        $atividade->save();
        return redirect('/lista_atividades')->with('success', 'Dados alterados com sucesso!');
    }


public function excluir_atividade($id)
{
    $atividade = Atividades::findOrFail($id);
    $atividade->delete();
    return redirect('/lista_atividades')->with('delete', 'Dados apagados.');
}


    public function criar_estado(Request $request)
    {

        $estado= new Estados();

        $estado->nome= $request->input('novo_estado');
        $estado->save();
        return redirect('/lista_atividades');
    }


    public function criar_solicitante(Request $request)
    {

        $solicitante= new Solicitantes();

        $solicitante->nome= $request->input('novo_solicitante');
        $solicitante->save();
        return redirect('/lista_atividades');
    }

    public function download() {

        $pdf = Pdf::loadView('layouts\teste');

        return $pdf->download();
    }


    public function selectmes(Request $request){


    $mesSelecionado = $request->input('mes_selecionado');

    $relatorio = Atividades::where('id_mes', $mesSelecionado)->get();

    $dompdf= new Dompdf ();



    $html = view('layouts\pdfatividades', ['relatorio' => $relatorio, 'mes'=>$mesSelecionado])->render();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();


    return $dompdf->stream('relatorio.pdf');


 //$pdf = Pdf::loadView('layouts\pdfatividades', ['relatorio' => $relatorio, 'mes'=>$mesSelecionado]);

    //$pdf->download();
    //return view('layouts/pdfatividades', ['relatorio'=>$relatorio, 'mes'=>$mesSelecionado]);


    }

}
