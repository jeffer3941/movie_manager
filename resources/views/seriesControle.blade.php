@extends('layout')

@section('cabecalho')
Series
@endsection

@section('conteudo')
@if(!empty($mensagem))
<div class="alert alert-success">
{{$mensagem}}
</div>
@endif
<a class="btn btn-secondary mb-2" href="{{route('criarSerie')}}">Adicionar</a>
<ul class="list-group">
    @foreach($listaSeries as $serie)
        <li class="list-group-item d-flex justify-content-between align">
            <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
            <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                <input type="text" class="form-control" value="{{ $serie->nome }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editarSerie(`{{$serie->id}}`)">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <span class="d-flex">
                <button class="btn btn-info btn-sm mr-1" onclick="toggleInput(`{{ $serie->id }}`)">
                <i class="fas fa-edit"></i>
                </button>
                <a href="/serie/{{$serie->id}}/temporadas" class="btn btn-info btn-sm mr-1">
                t
                </a>
                <form method="post" action="/series/{{$serie->id}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </span>
          
        </li>
    @endforeach
</ul> 

<script>
    function toggleInput(serieId) {
        const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
        const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
        if (nomeSerieEl.hasAttribute('hidden')) {
            nomeSerieEl.removeAttribute('hidden');
            inputSerieEl.hidden = true;
        } else {
            inputSerieEl.removeAttribute('hidden');
            nomeSerieEl.hidden = true;
        }
    }
    function editarSerie(serieId) {
        let formData = new FormData();
        const nome = document
            .querySelector(`#input-nome-serie-${serieId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = `/series/${serieId}/editaNome`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
        toggleInput(serieId);
         document.getElementById(`nome-serie-${serieId}`).textContent = nome;
        });
    } 
</script>
@endsection
