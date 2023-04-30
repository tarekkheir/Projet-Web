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
    <a href="{{route('etudiant.inscription')}}">Inscription au cours</a>
    @else
    <h1>Liste des Cours {{auth()->user()->formation()->get()[0]->intitule}}</h1>
    <a href="{{route('etudiant.inscription')}}">Inscription au cours</a>
    <table class="table">
        <tr class="head">
            <th>Intitulé</th>
            <th>Formation</th>
        </tr>
        @foreach($cours as $cour)
        <tr>
            <td class="cell">{{$cour->intitule}}</td>
            <td class="cell">{{$cour->formation()->get()[0]->intitule}}</td>
            <td class="cell">
                <form method="post" action="{{route('etudiant.desinscription', ['cours_id' => $cour->id])}}">
                    <button type="submit" class="btn-danger">Se désinscrire</button>
                    @csrf
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @endif
</div>
@endsection