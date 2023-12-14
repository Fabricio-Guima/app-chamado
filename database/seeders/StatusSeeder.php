<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::firstOrCreate(['name' => 'aberto', 'slug' => 'aberto', 'color' => 'info','description' => 'Este status significa que a ocorrência foi notificado à equipe de suporte e em algum momento o suporte será feito.']);
        Status::firstOrCreate(['name' => 'em andamento', 'slug' => 'em-andamento', 'color' => 'warning','description' => 'Este status significa que a ocorrência está sendo verificada pelo setor responsável.']);
        Status::firstOrCreate(['name' => 'em observação', 'slug' => 'em-observacao', 'color' => 'primary','description' => 'Este status significa que aparentemente a ocorrência foi sanada, porém é necessário observar o comportamento da solução do setor responsável.']);
        Status::firstOrCreate(['name' => 'finalizado', 'slug' => 'finalizado', 'color' => 'success','description' => 'Este status significa que a ocorrência foi resolvida pelo setor responsável.']);
        Status::firstOrCreate(['name' => 'rejeitado', 'slug' => 'rejeitado', 'color' => 'danger','description' => 'Este status significa que a ocorrência foi rejeitada pelo setor responsável por falta de informação ou porque no momento não faz sentido solucionar esta ocorrência.']);
    }
}
