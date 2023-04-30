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
                <a href="/enseignant/listeCoursEnseignant/{{auth()->user()->id}}">Mes cours</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('enseignant.planning')}}">Gestion Planning</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('enseignant.planningIntegral')}}">Planning Integral</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('enseignant.planningCoursListe')}}">Planning par cours</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('enseignant.planningSemaine')}}">Planning par semaine</a>
            </li>
        </ul>
    </div>
</div>
@endsection