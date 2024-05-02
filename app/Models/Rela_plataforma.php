<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rela_plataforma extends Model
{
    use HasFactory;

    protected $table = 'relatorio_plataformas';
protected $fillable = ['id_plataforma', 'id_usuario', 'descricao', 'id_categoria', 'disponibilidade', 'data', 'desempenho', 'created_at', 'updated_at'];

public function categorias()
{
    return $this->belongsTo(Categorias::class, 'id_categoria', 'id'); 
}

public function plataformas()
{
    return $this->belongsToMany(User::class, 'relatorio_plataformas'); 
} 



public function usuarios()
{
    return $this->belongsToMany(User::class, 'relatorio_plataformas', 'id_usuario', 'id_plataforma')->withTimestamps(); 
}


}
