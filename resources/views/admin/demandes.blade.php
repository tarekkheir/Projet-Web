@extends('modele.main')

@section('contents')
<div class="commandes">
    @if($errors->any())
    @foreach($errors->all() as $e)
    <br>{{$e}}<br>
    @endforeach
    @endif
    @if(sizeof($users) == 0)
    <h1>Aucune demandes de création de compte</h1>
    @else
    <h3>Demandes de création de compte</h3>
    <ul class="liste">
        @foreach($users as $user)
        @if($user->formation_id == 0)
        <li class="liste-item">
            <span>{{$user->nom}} {{$user->prenom}} | Enseignant</span>
            <form method="post" class="form" action="{{route('admin.updateType', [
                                            'user_id' => $user->id,
                                            'type' => 'enseignant'])}}">
                <button type="submit" class="btn-primary">Accepter</button>
                @csrf
            </form>
            <form method="post" action="{{route('admin.deleteUser', ['id' => $user->id])}}">
                <button type="submit" class="btn-danger">Refuser</button>
                @csrf
            </form>
        </li>
        @else
        <li class="liste-item">
            <span>{{$user->nom}} {{$user->prenom}} | Etudiant</span>
            <form method="post" class="form" action="{{route('admin.updateType', [
                                            'user_id' => $user->id,
                                            'type' => 'etudiant'])}}">
                <button class="btn-primary">Accepter</button>
                @csrf
            </form>
            <form method="post" action="{{route('admin.deleteUser', ['id' => $user->id])}}">
                <button class="btn-danger">Refuser</button>
                @csrf
            </form>
        </li>
        @endif
        @endforeach
    </ul>
    @endif
</div>
@endsection