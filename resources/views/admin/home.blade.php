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
                <a href="{{route('admin.listeFormation')}}">Liste des formations</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('admin.listeCours')}}">Liste des cours</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('admin.demandes')}}">Demandes de création de compte</a>
            </li>
        </ul>
    </div>
</div>
@endsection