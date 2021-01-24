<?php

namespace Crud\Traits;

trait HasFilters {

    /**
     * Adiciona o scope referente 
     * aos filtros.
     * 
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}