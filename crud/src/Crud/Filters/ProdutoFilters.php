<?php

namespace Crud\Filters;

class ProdutoFilters extends Filters
{
    /**
     * List of all avaliable filters.
     *
     * @var array
     */
    protected $filters = [
        's', 
        'codigo', 
        'titulo', 
        'valor_inicial', 
        'valor_final', 
    ];

    protected function s($keyword)
    {
        return $this->builder->where(function($q) use ($keyword) {
            $q->orWhere('codigo', 'like', '%' . $keyword . '%');
            $q->orWhere('titulo', 'like', '%' . $keyword . '%');
        });
    }

    protected function codigo($codigo)
    {
        return $this->builder->where('codigo', $codigo);
    }

    protected function titulo($titulo)
    {
        return $this->builder->where('titulo', 'like', '%' . $titulo . '%');
    }

    protected function valor_inicial($valor)
    {
        return $this->builder->where('valor', '>=', $valor);
    }

    protected function valor_final($valor)
    {
        return $this->builder->where('valor', '<=', $valor);
    }
}