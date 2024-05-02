<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorio_mensal extends Model
{
    use HasFactory;
    protected $table = 'relatorio_mensal';
    protected $fillable = ['id', 'ano', 'id_mes', 'id_plataforma', 'id_usuario', 'id_categoria', 'descricao','disponibilidade'];


    public function meses()
{
    return $this->belongsTo(Mes::class, 'id_mes'); 
}

public function plataformas()
{
    return $this->belongsTo(Plataformas::class, 'id_plataforma'); 
}
public function categorias()
{
    return $this->belongsTo(Categorias::class, 'id_categoria'); 
}

public function usuarios()
{
    return $this->belongsTo(User::class, 'id_usuario'); 
}

}
