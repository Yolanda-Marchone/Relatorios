<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $table = 'categorias';
protected $fillable = ['id', 'nome'];


public function relatorio_mensal()
{
    return $this->hasMany(Relatorio_mensal::class); 

}
}
