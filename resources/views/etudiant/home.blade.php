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
    <h1>Admin Page</h1>
    <div class="navigation">
        <ul class="navigation-liste">
            <li class="navigation-liste-item">
                <a href="/etudiant/listeCoursEtudiant/{{auth()->user()->id}}">Mes cours</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('etudiant.listeCoursFormation')}}">Liste des cours</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('etudiant.planningIntegral')}}">Planning Integral</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('etudiant.planningCoursListe')}}">Planning par cours</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('etudiant.planningSemaine')}}">Planning par semaine</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('user.updatePassword')}}">Modifier le MDP</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('user.updateName')}}">Modifier Nom/Prénom</a>
            </li>
        </ul>
    </div>
</div>
@endsection