<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividades extends Model
{
    use HasFactory;
    protected $table = 'atividades';
    protected $fillable = ['id', 'ano', 'id_mes', 'id_estado', 'id_usuario', 'id_solicitante', 'descricao','detalhe', 'data_progresso'];


    public function meses()
{
    return $this->belongsTo(Mes::class, 'id_mes');
}

public function estados()
{
    return $this->belongsTo(Estados::class, 'id_estado');
}
public function solicitantes()
{
    return $this->belongsTo(Solicitantes::class, 'id_solicitante');
}

public function usuarios()
{
    return $this->belongsTo(User::class, 'id_usuario');
}
}
