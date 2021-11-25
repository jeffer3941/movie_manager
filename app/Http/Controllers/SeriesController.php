<?php 

namespace App\Http\Controllers;

use App\Models\Episodio;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Temporada;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;

class SeriesController extends Controller
{
    public function index(Request $request){
        $listaSeries = Serie::query()->orderBy('nome')->get();

        $mensagem = $request->session()->get('mensagem');

        return view('seriesControle',compact('listaSeries','mensagem'));
    }
    public function create() 
    {
        return view('createSerie');
    }
    public function store(Request $request, CriadorDeSerie $criadorDeSerie)
    {                 
        $serie = $criadorDeSerie->criarSerie($request->nome,
        $request->n_temp,
        $request->n_ep);
        
        $request->session()->flash(
            'mensagem',
            "$serie->nome criado com sucesso codigo $serie->id");
        return redirect()->route('mainPage');
        
    }
    public function destroy(Request $request, RemovedorDeSerie $remover)
    {
        $serieNome = $remover->removerSerie($request->id);
       
        $request->session()->flash(
            'mensagem',
            "Serie $serieNome Apagada");
           return redirect()->route('mainPage');
    }
    public function editaNome(Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($request->id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}