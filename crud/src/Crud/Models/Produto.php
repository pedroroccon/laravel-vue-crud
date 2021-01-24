<?php

namespace Crud\Models;

use Crud\Traits\HasFactory;
use Crud\Traits\HasFilters;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory, HasFilters;

    /**
     * Define os campos associados 
     * ao recurso que podem ser 
     * preenchidos, evitando ataques 
     * do tipo Mass Assingment.
     * 
     * @var array
     */
    protected $fillable = [
        'codigo', 
        'titulo', 
        'valor', 
        'observacao'
    ];

    /**
     * Definindo um accessor para o 
     * atributo valor, convertendo 
     * o valor armazenado de centavos 
     * para reais.
     * 
     * @param  int  $valor
     * @return float
     */
    public function getValorAttribute($valor)
    {
        return $valor / 100;
    }

    /**
     * Definindo um mutator para converter 
     * os valores digitados para número 
     * inteiros (operação inversa ao accessor).
     * 
     * @param  float  $valor
     * @return void
     */
    public function setValorAttribute($valor)
    {
        $this->attributes['valor'] = $valor * 100;
    }
}
