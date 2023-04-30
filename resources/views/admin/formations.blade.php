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
    @if(empty($formations[0]))
    <h1>Aucune Formation enregistrer</h1>
    <a href="{{route('admin.addFormation')}}">Ajouter une formation</a>
    @else
    <h1>Liste des Formations</h1>
    <a href="{{route('admin.addFormation')}}">Ajouter une formation</a>
    <table class="table">
        <tr class="head">
            <th>Intitulé</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        @foreach($formations as $formation)
        <tr>
            <td class="cell">{{$formation->intitule}}</td>
            <td class="cell">
                <form method="GET" action="{{route('admin.editFormation', ['id' => $formation->id])}}">
                    <button type="submit" class="btn-primary">Modifier</button>
                </form>
            </td>
            <td class="cell">
                <form method="POST" action="{{route('admin.supprimerFormation', ['id' => $formation->id])}}">
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