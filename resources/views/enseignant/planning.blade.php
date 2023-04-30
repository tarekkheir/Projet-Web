@extends('modele.main')

@section('contents')
<div class="commandes">
    @if($errors->any())
    @foreach($errors->all() as $e)
    <br>{{$e}}<br>
    @endforeach
    @endif
    @if(Session::has('message'))
    <span>{{Session::get('message')}}</span>
    @endif
    @if(sizeof($plannings) == 0)
    <h1>Aucun cours</h1>
    <a href="{{route('enseignant.ajouterUneSeance')}}">Ajouter une séance</a>
    @else
    <h1>Planning</h1>
    <a href="{{route('enseignant.ajouterUneSeance')}}">Ajouter une séance</a>
    <table class="table">
        <tr class="head">
            <th>Intitulé</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        @foreach($plannings as $planning)
        <tr>
            <td class="cell">{{$planning->cours()->get()[0]->intitule}}</td>
            <td class="cell">{{explode('T', $planning->date_debut)[0]}}</td>
            <td class="cell">{{explode('T', $planning->date_debut)[1]}}-{{explode('T', $planning->date_fin)[1]}}</td>
            <td class="cell">
                <form method="GET" action="{{route('enseignant.edit', ['id' => $planning->id])}}">
                    <button type="submit" class="btn-primary">Modifier</button>
                </form>
            </td>
            <td class="cell">
                <form method="POST" action="{{route('enseignant.supprimer', ['id' => $planning->id])}}">
                    <button type="submit" class="btn-danger">Supprimer</button>
                    @csrf
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @endif
</div>
@endsection