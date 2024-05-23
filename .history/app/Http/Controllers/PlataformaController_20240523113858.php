<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Plataformas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mes;
use App\Models\Rela_plataforma;
use App\Models\Relatorio_mensal;
use App\Models\User;
use App\Rules\ValidacaoData;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;


class PlataformaController extends Controller
{


    public function exibir_dados()
    {
        $plataformas = Plataformas::all();
        $categorias= Categorias:: all();
        $mes= Mes:: all();

        return view('layouts/cadastrarplataforma', ['plataformas' => $plataformas, 'categorias'=>$categorias, 'mes'=>$mes]);

}

public function ver_mes()
{



    return view('layouts/app', []);

}

public function ver_relatorio()
{

    $mes= Mes::all();

    return view('layouts/ver_relatorios', ['mes'=>]);

}


    public function exibir_dados_plataforma()
    {

        $relatorio= Relatorio_mensal::all();
        $mes = Relatorio_mensal::select('id_mes')->distinct()->get();
        $plataforma = Relatorio_mensal::select('id_plataforma')->distinct()->get();

        return view('layouts/plataforma', ['relatorio'=>$relatorio, 'mes'=>$mes, 'plataforma'=>$plataforma]);
    }

    public function adicionar_elementos()
    {
       return view('layouts/adicionar');}



    public function gerar_relatorio()
    {

        $relatorio= Relatorio_mensal::all();
        $mes = Relatorio_mensal::select('id_mes')->distinct()->get();
        $plataforma = Relatorio_mensal::select('id_plataforma')->distinct()->get();

 $dompdf= new Dompdf ();


 $html = view('layouts.plataforma', compact('relatorio', 'mes', 'plataforma'))->render();

 $dompdf->loadHtml($html);
 $dompdf->setPaper('A4', 'portrait');
 $dompdf->render();


        return $dompdf->stream('relatorio.pdf', ['relatorio'=>$relatorio, 'mes'=>$mes, 'plataforma'=>$plataforma]);
    }



    public function dados_relatorio()
    {

        $relatorio_p = Rela_plataforma::with('categorias')->first();
        $relatorio= Relatorio_mensal::with('meses')->get();
        $mes=Mes::all();

        return view('layouts/plataforma', ['relatorio_p'=>$relatorio_p, 'relatorio'=>$relatorio, 'mes'=>$mes]);
    }


    public function criar_relatorio_plataforma(Request $request)
    {

       // $userId = Auth::id();
        $user1 = new Relatorio_mensal();
        $user1->descricao = $request->input('descricao');
        $user1->id_categoria = $request->input('categorias');

        if($request->input('categorias')==1){

           $user1->disponibilidade= 5;

        }

        else
    {
        $user1->disponibilidade= 9;
    }
        $user1->id_plataforma = $request->input('plataformas');
        $user1->id_mes = Carbon::now()->format('m');
        $user1->ano = Carbon::now()->year;
        $user1->id_usuario = Auth::id();

        $user1->save();



        return redirect('/lista_plataforma');
    }

    public function criar_categoria(Request $request)
    {

        $categoria= new Categorias();

        $categoria->nome= $request->input('nova_categoria');
        $categoria->save();
        return redirect('/lista_plataforma');
    }


    public function criar_plataforma(Request $request)
    {

        $plataforma= new Plataformas();

        $plataforma->nome= $request->input('nova_plataforma');
        $plataforma->save();
        return redirect('/lista_plataforma')->with('Sucesso', 'Plataforma adicionada com sucesso.');
    }




    public function editarPlataforma($id)
{
    // Busca a atividade pelo ID
    $relatorio = Relatorio_mensal::find($id);

    // Verifica se a atividade foi encontrada
    if (!$relatorio) {
        // Retorna uma resposta para o caso de atividade não encontrada
        return response()->json(['message' => 'Atividade não encontrada.'], 404);
    }

    // Carrega os solicitantes e estados para exibição nos campos de seleção
    $plataformas = Plataformas::all();
    $categorias = Categorias::all();
    $mes = Mes::all();


    return view('layouts/editarplataforma', ['categorias' => $categorias, 'plataformas'=>$plataformas, 'mes'=>$mes, 'relatorio'=>$relatorio]);}




    public function editar_plataforma(Request $request, $id)
    {


        $user1 = Relatorio_mensal::findOrFail($id);
        $user1->descricao = $request->input('descricao');
        $user1->id_categoria = $request->input('categorias');

        if($request->input('categorias')==1){

           $user1->disponibilidade= 5;

        }

        else
    {
        $user1->disponibilidade= 9;
    }
        $user1->id_plataforma = $request->input('plataformas');
        $user1->id_mes=$request->input('mes');
        $user1->ano=$request->input('ano');
        $request->validate([
            'ano' => 'required|integer|min:2024',
        ], [
            'ano.min' => 'O ano deve ser igual ou superior a 2024.',
        ]);

        $user1->save();

        //Session::flash('sucess', 'As alterações foram salvas com sucesso.');

        return redirect('/lista_plataforma')->with('success', 'Dados alterados com sucesso!');
    }



    public function excluir_plataforma($id)
{
    $relatorio = Relatorio_mensal::findOrFail($id);
    $relatorio->delete();
    return redirect('/lista_plataforma')->with('delete', 'Dados apagados.');
}

    public function desempenho(){


        $numero_registo = Relatorio_mensal::count();
        $disponibilidade_total=Relatorio_mensal::sum('disponibilidade');

        $percentagem= ($numero_registo/$disponibilidade_total)*100;
        $percentagem_round = round($percentagem, 2);

        return $percentagem_round;
    }



    public function relatorio_pdf() {
        $dados = Relatorio_mensal::all();

        $dompdf = new Dompdf();
        $html = View::make('layouts/relatorio_PDF', compact('dados'))->render();
        $dompdf->loadHtml($html);

        // Renderizar PDF
        $dompdf->render();

        // Retornar PDF como uma resposta HTTP
        return $dompdf->stream();
    }




    /*private function processar_relatorio($mes)
    {
        $relatorio = Relatorio_mensal::where('id_mes', $mes)->get();

        return $relatorio;
    }*/


      /*  public function gerar(Request $request)
        {
            $id_mes=$request->input('mes_selecionado');
        // $mes = $request->input('mes_selecionado');

            //$relatorio = $this->processar_relatorio($mes);

        $relatorio = Relatorio_mensal::where('id_mes', $id_mes)->get();


        //$numero_registo= Relatorio_mensal::where('id_mes', $mes)->count();


        //$disponibilidade_total=Relatorio_mensal::where('id_mes', $mes)->sun('disponibilidade');;

        //$percentagem= ($numero_registo/100)*100;
        //$percentagem_round = round($percentagem, 2);

            //return view('layouts/teste', ['relatorio'=>$relatorio]);
            dd($relatorio);

        }*/



        public function pdf(Request $request)
        {


            $mesSelecionado = $request->input('mes_selecionado');

            $relatorio = Relatorio_mensal::where('id_mes', $mesSelecionado)->select('id_plataforma')->distinct()->get();

            $esura= Relatorio_mensal::where('id_mes', $mesSelecionado)->where('id_plataforma', 1)->get();
            $biblioteca= Relatorio_mensal::where('id_mes', $mesSelecionado)->where('id_plataforma', 2)->get();
            $revista= Relatorio_mensal::where('id_mes', $mesSelecionado)->where('id_plataforma', 3)->get();
            $email= Relatorio_mensal::where('id_mes', $mesSelecionado)->where('id_plataforma', 4)->get();
            $moodle= Relatorio_mensal::where('id_mes', $mesSelecionado)->where('id_plataforma', 5)->get();




            //Criar a percentagem da Plataforma Moodle



            $moodletotal = Relatorio_mensal::where('id_mes', $mesSelecionado)
            ->where('id_plataforma', 5)
            ->count();

if($moodletotal>0){

            $moodleusuario= Relatorio_mensal::where('id_mes', $mesSelecionado)
            ->where('id_plataforma', 5)
            ->where('id_categoria', 1)
            ->count();


            $moodlesistema = Relatorio_mensal::where('id_mes', $mesSelecionado)
            ->where('id_plataforma', 5)
            ->where('id_categoria', 2)
            ->count();

            $percentagem_moodleusuario = ($moodleusuario / $moodletotal) * 60;
            $percentagem_moodlesistema = ($moodlesistema / $moodletotal) * 40;
            $percentagem_total = $percentagem_moodleusuario + $percentagem_moodlesistema;
}

else{
    $percentagem_total=100;
}
                    //Criar a percentagem do Esura

                    $esuratotal = Relatorio_mensal::where('id_mes', $mesSelecionado)
                    ->where('id_plataforma', 1)
                    ->count();
if($esuratotal>0){
                    $esurausuario= Relatorio_mensal::where('id_mes', $mesSelecionado)
                    ->where('id_plataforma', 1)
                    ->where('id_categoria', 1)
                    ->count();

                    $esurasistema = Relatorio_mensal::where('id_mes', $mesSelecionado)
                    ->where('id_plataforma', 1)
                    ->where('id_categoria', 2)
                    ->count();
                    $percentagem_esurausuario = ($esurausuario / $esuratotal) * 60;
                    $percentagem_esurasistema = ($esurasistema / $esuratotal) * 40;
                    $percentagem_total_esura = $percentagem_esurausuario + $percentagem_esurasistema;
}
else{ $percentagem_total_esura=100;}

                     //Criar a percentagem da Biblioteca Virtual

      $bibliotecatotal = Relatorio_mensal::where('id_mes', $mesSelecionado)
      ->where('id_plataforma', 2)
      ->count();

if($bibliotecatotal>0){
      $bibliotecausuario= Relatorio_mensal::where('id_mes', $mesSelecionado)
      ->where('id_plataforma', 2)
      ->where('id_categoria', 1)
      ->count();

      $bibliotecasistema = Relatorio_mensal::where('id_mes', $mesSelecionado)
      ->where('id_plataforma', 2)
      ->where('id_categoria', 2)
      ->count();
      $percentagem_bibliotecausuario = ($bibliotecausuario / $bibliotecatotal) * 60;
      $percentagem_bibliotecasistema = ($bibliotecasistema / $bibliotecatotal) * 40;
      $percentagem_total_biblioteca = $percentagem_bibliotecausuario + $percentagem_bibliotecasistema;
}
else{$percentagem_total_biblioteca=100;}

            //Criar a percentagem da Revista cientifica

            $revistatotal = Relatorio_mensal::where('id_mes', $mesSelecionado)
            ->where('id_plataforma', 3)
            ->count();

if($revistatotal>0){
            $revistausuario= Relatorio_mensal::where('id_mes', $mesSelecionado)
            ->where('id_plataforma', 3)
            ->where('id_categoria', 1)
            ->count();

            $revistasistema = Relatorio_mensal::where('id_mes', $mesSelecionado)
            ->where('id_plataforma', 3)
            ->where('id_categoria', 2)
            ->count();
            $percentagem_revistausuario = ($revistausuario / $revistatotal) * 60;
            $percentagem_revistasistema = ($revistasistema / $revistatotal) * 40;
            $percentagem_total_revista = $percentagem_revistausuario + $percentagem_revistasistema;
}
else {$percentagem_total_revista=100;}

                  //Criar a percentagem do E-mail

                  $emailtotal = Relatorio_mensal::where('id_mes', $mesSelecionado)
                  ->where('id_plataforma', 4)
                  ->count();
if($emailtotal>0){
                  $emailusuario= Relatorio_mensal::where('id_mes', $mesSelecionado)
                  ->where('id_plataforma', 4)
                  ->where('id_categoria', 1)
                  ->count();

                  $emailsistema = Relatorio_mensal::where('id_mes', $mesSelecionado)
                  ->where('id_plataforma', 4)
                  ->where('id_categoria', 2)
                  ->count();
                  $percentagem_emailusuario = ($emailusuario / $emailtotal) * 60;
                  $percentagem_emailsistema = ($emailsistema / $emailtotal) * 40;
                  $percentagem_total_email = $percentagem_emailusuario + $percentagem_emailsistema;

}
else{$percentagem_total_email=100;}

            $pdf = Pdf::loadView('layouts\pdf', ['relatorio'=>$relatorio, 'mes'=>$mesSelecionado, 'moodle'=>$moodle,
            'biblioteca'=>$biblioteca, 'esura'=>$esura,'revista'=>$revista, 'email'=>$email, 'percmoodle'=>$percentagem_total,
             'percesrura'=>$percentagem_total_esura, 'percemail'=>$percentagem_total_email, 'percrevista'=>$percentagem_total_revista, 'percbiblioteca'=>$percentagem_total_biblioteca]);



           return $pdf->download();
            //return view('layouts/pdf', ['relatorio'=>$relatorio, 'mes'=>$mesSelecionado, 'moodle'=>$moodle, 'biblioteca'=>$biblioteca, 'esura'=>$esura, 'revista'=>$revista, 'email'=>$email, 'percmoodle'=>$percentagem_total]);
        }





}
