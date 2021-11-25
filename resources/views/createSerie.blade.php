@extends('layout')

@section('cabecalho')
Criar Series
@endsection

@section('conteudo')
<form method="post">
    @csrf

    <div class="row">
        <div class="col col-8">
            <label for="nome" class="form-label">Nome da Serie</label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Ex: The walking dead">
        </div>
        <div class="col col-2">
            <label for="n_temp" class="form-label">Nº Temporadas</label>
            <input type="number" class="form-control" name="n_temp" id="n_temp">
        </div>
        <div class="col col-2">
            <label for="n_ep" class="form-label">Nº Episodios</label>
            <input type="number" class="form-control" name="n_ep" id="n_ep">
        </div>
       
    </div> 
    <div class="md-2">
    </div>
    <button type="submit" class="btn btn-primary mt-2">Enviar</button>
</form>             
@endsection        
