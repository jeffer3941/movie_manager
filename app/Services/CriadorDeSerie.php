<?php

namespace App\Services;

use App\Models\Serie;


class CriadorDeSerie
{
    public function criarSerie($nome, $qtd_temporadas, $n_ep) 
    {
        $serie = Serie::create(['nome' => $nome]);
      
        for($i = 1; $i <= $qtd_temporadas; $i ++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            for($j = 1; $j <= $n_ep; $j ++) {
               $temporada->episodios()->create(['numero' => $j]);
            }
        }
        return $serie;
    }
}