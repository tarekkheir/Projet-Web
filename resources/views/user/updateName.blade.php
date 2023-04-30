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
    <div class="form-container">
        <form method="post" class="form">
            @method('put')
            <h1>Modifier le Nom/Prénom</h1>
            <div class="form-group">
                <label class="form-label">Nom</label>
                <input class="form-field" type="text" name="nom" value="{{$user->nom}}">
            </div>
            <div class="form-group">
                <label class="form-label">Prénom</label>
                <input class="form-field" type="text" name="prenom" value="{{$user->prenom}}">
            </div>
            <button class="btn btn-primary btn-ghost" type="submit">Envoyer</button>
            @csrf
        </form>
    </div>
</div>
@endsection