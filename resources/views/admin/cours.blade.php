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
    @if(empty($cours[0]))
    <h1>Aucun cours enregistrer</h1>
    <a href="{{route('admin.addCours')}}">Ajouter un cours</a>
    @else
    <h1>Liste des Cours</h1>
    <a href="{{route('admin.addCours')}}">Ajouter un cours</a>
    <table class="table">
        <tr class="head">
            <th>Intitulé</th>
            <th>Formation</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        @foreach($cours as $cour)
        <tr>
            <td class="cell">{{$cour->intitule}}</td>
            <td class="cell">{{$cour->formation()->get()[0]->intitule}}</td>
            <td class="cell">
                <form method="GET" action="{{route('admin.modifier', ['id' => $cour->id])}}">
                    <button type="submit" class="btn-primary">Modifier</button>
                </form>
            </td>
            <td class="cell">
                <form method="POST" action="{{route('admin.supprimerCours', ['id' => $cour->id])}}">
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