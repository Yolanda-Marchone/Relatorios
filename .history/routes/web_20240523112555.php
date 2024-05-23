<?php

use App\Models\Categorias;
use App\Models\Mes;
use App\Models\Rela_plataforma;
use App\Models\Relatorio_mensal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\PlataformaController::class, 'exibir_dados_plataforma'])->name('layouts/plataforma')->middleware('auth');

Route::get('/lista_plataforma', [App\Http\Controllers\PlataformaController::class, 'exibir_dados_plataforma'])->name('layouts/plataforma')->middleware('auth');

Route::get('/lista_atividades', [App\Http\Controllers\AtividadesController::class, 'exibir_dados_atividade'])->name('layouts/atividade')->middleware('auth');

Route::get('/atividades', [App\Http\Controllers\AtividadesController::class, 'exibir_dados'])->name('layouts/cadastraratividade')->middleware('auth');

Route::get('/plataforma', [App\Http\Controllers\PlataformaController::class, 'exibir_dados'])->name('layouts/cadastrarplataforma')->middleware('auth');

Route::post('/submeter_plataformas', [App\Http\Controllers\PlataformaController::class, 'criar_relatorio_plataforma'])->name('layouts/plataforma');

Route::post('/submeter_atividades', [\App\Http\Controllers\AtividadesController::class, 'criar_relatorio_atividade'])->name('layouts/atividades');

Route::get('/gerarpdf', [\App\Http\Controllers\AtividadesController::class, 'download']);

Route::get('/selecionarmes', [\App\Http\Controllers\AtividadesController::class, 'selectmes'])->name('layouts/pdfatividades');

Route::get('/testeview', [App\Http\Controllers\AtividadesController::class, 'teste'])->name('layouts/relatorio_PDF')->middleware('auth');


Route::get('/pdf', [App\Http\Controllers\PlataformaController::class, 'pdf']);

Route::get('/adicionar', [App\Http\Controllers\PlataformaController::class, 'adicionar_elementos'])->name('layouts/adicionar_elementos')->middleware('auth');

Route::post('/submeter_categoria', [App\Http\Controllers\PlataformaController::class, 'criar_categoria'])->name('layouts/plataforma');

Route::post('/submeter_plataforma', [App\Http\Controllers\PlataformaController::class, 'criar_plataforma'])->name('layouts/plataforma');

Route::post('/submeter_estado', [\App\Http\Controllers\AtividadesController::class, 'criar_estado'])->name('layouts/atividades');

Route::post('/submeter_solicitante', [\App\Http\Controllers\AtividadesController::class, 'criar_solicitante'])->name('layouts/atividades');

Route::get('/editar_atividades/{id}', [\App\Http\Controllers\AtividadesController::class, 'editarAtividade'])->name('layouts/editaratividades');

Route::put('/salvar_atividades/{id}', [\App\Http\Controllers\AtividadesController::class, 'editar_atividade'])->name('layouts/atividades');

Route::delete('/apagar_atividades/{id}', [\App\Http\Controllers\AtividadesController::class, 'excluir_atividade'])->name('layouts/atividades');

Route::get('/editar_plataforma/{id}', [\App\Http\Controllers\PlataformaController::class, 'editarPlataforma'])->name('layouts/editarplataforma');

Route::put('/salvar_plataforma/{id}', [\App\Http\Controllers\PlataformaController::class, 'editar_plataforma'])->name('layouts/plataforma');

Route::delete('/apagar_plataforma/{id}', [\App\Http\Controllers\PlataformaController::class, 'excluir_plataforma'])->name('layouts/plataforma');


Route:: get ('/3', function(){
$pdf= Pdf::loadView('layouts\teste');
return $pdf->download('teste.pdf');

});




Route::get('/gerar-pdf', function () {
    // Cria uma instância do Dompdf com opções padrão
    $dompdf= new Dompdf ();


    // Renderiza a view em HTML
    $html = view('layouts\teste')->render();

    // Carrega o HTML no Dompdf
    $dompdf->loadHtml($html);

    // Define o tamanho do papel e a orientação
    $dompdf->setPaper('A4', 'portrait');

    // Renderiza o PDF
    $dompdf->render();

    // Saída do PDF
    return $dompdf->stream('relatorio.pdf');
});


