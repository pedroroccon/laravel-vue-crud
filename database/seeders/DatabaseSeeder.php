<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Criando um seeder para 
        // adicionar produtos no sistema
        $produtos = [
            'AP01' => 'iPhone 11 Apple 128GB Preto Tela de 6,1”, Câmera Dupla de 12MP, iOS', 
            'AP02' => 'iPhone 12 Apple 64GB Branco Tela de 6,1”, Câmera Dupla de 12MP, iOS', 
            'AP03' => 'iPhone 12 Pro Max Apple 256GB Grafite Tela de 6,7”, Câmera Tripla de 12MP, iOS', 
            'SM01' => 'Smart TV 70" Crystal UHD TU7000 4K, Design sem Limites, Controle Único, Visual Livre de Cabos, Bluetooth, Processador Crystal 4K', 
            'SM02' => 'Smartphone Samsung Galaxy S20+ Preto 128GB, 8GB RAM, Tela Infinita de 6.7", Câmera Traseira Quádrupla, Câmera Frontal 10MP, IP68 e Leitor de Digital', 
            'SM03' => 'Smartphone Samsung Galaxy A51 Preto 128GB, Tela Infinita de 6.5", Câmera Traseira Quádrupla, Leitor Digital na Tela, Android e Processador Octa-Core'
        ];

        foreach($produtos as $codigo => $titulo) {
            \Crud\Models\Produto::factory()->create([
                'codigo' => $codigo, 
                'titulo' => $titulo
            ]);
        }        
    }
}
