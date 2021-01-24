<?php

namespace Crud\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory as FactoriesFromEloquent;

trait HasFactory
{

    use FactoriesFromEloquent;

    /**
     * Define onde devemos carregar 
     * a factory referente a este modelo.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        $class = static::class;
        $factoryNamespace = Str::beforeLast($class, '\\') . '\\Factories\\' . Str::afterLast($class, '\\') . 'Factory';
        return $factoryNamespace::new();
    }
}