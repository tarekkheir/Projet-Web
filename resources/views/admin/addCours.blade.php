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
            <h1>Ajouter un cours</h1>
            <div class="form-group">
                <label class="form-label">Intitule</label>
                <input class="form-field" type="text" name="intitule" value="{{old('intitule')}}">
            </div>
            <div class="form-group">
                <select name="user_id">
                    <option value="">--Choisissez un enseignant--</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->nom}} {{$user->prenom}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select name="formation_id">
                    <option value="">--Choisissez une formation--</option>
                    @foreach($formations as $formation)
                    <option value="{{$formation->id}}">{{$formation->intitule}}</option>
                    @endforeach
                </select>
            </div> 
             <button class="btn btn-primary btn-ghost" type="submit">Envoyer</button>
            @csrf
        </form>
    </div>
</div>
@endsection