<?php 

namespace App\Services;

use App\Models\Serie;
use App\Models\Temporada;
use App\Models\Episodio;
use Illuminate\Support\Facades\DB;


class RemovedorDeSerie
{
    public function removerSerie($serieId)
    {
        $serieNome = '';
        DB::transaction(function() use ($serieId,&$serieNome){
            $serie = Serie::find($serieId);
            $serieNome = $serie->nome;
            $serie->temporadas->each(function (Temporada $temporada)
            {
                $temporada->episodios->each(function (Episodio $episodio){
                    $episodio->delete();
                });
                $temporada->delete();
            });
            
            $serie->delete();
        });   
        return $serieNome; 
    }
}