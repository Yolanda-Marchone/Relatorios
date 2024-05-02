<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rela_plataforma;
use Illuminate\Http\Request;

class Rela_plataformaController extends Controller
{
    public function lista_plataforma(){

        $relatorios= Rela_plataforma::with('categorias');

        return view('layouts/plataforma', ['relatorios'=>$relatorios]);
    }
}
