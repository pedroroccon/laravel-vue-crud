<?php

namespace Crud\Models\Factories;

use Crud\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * Define o modelo correspondente a essa factory.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define o estado padrão do modelo.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->bothify('######-??'), 
            'titulo' => $this->faker->sentence(3), 
            'valor' => $this->faker->numberBetween(100, 10000), 
            'observacao' => $this->faker->optional()->realText, 
        ];
    }
}