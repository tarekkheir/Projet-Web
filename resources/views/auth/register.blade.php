@extends('modele.main')

@section('contents')
@if($errors->any())
@foreach($errors->all() as $e)
<br>{{$e}}<br>
@endforeach
@endif
<div class="form-container">
    <form method="post" class="form">
        <h1>Enregistrement</h1>
        <div class="form-group">
            <label class="form-label">Login</label>
            <input class="form-field" type="text" name="login" value="{{old('login')}}">
        </div>
        <div class="form-group">
            <label class="form-label">Prenom</label> 
            <input class="form-field" type="text" name="prenom" value="{{old('prenom')}}">
        </div>
        <div class="form-group">
            <label class="form-label">Nom</label> 
            <input class="form-field" type="text" name="nom" value="{{old('nom')}}">
        </div>
        <div class="form-group">
            <label class="form-label">MDP</label> 
            <input class="form-field" type="password" name="mdp">
        </div>
        <div class="form-group">
            <label class="form-label">MDP Confirmation</label>
            <input class="form-field" type="password" name="mdp_confirmation">
        </div>
        <div class="form-group">
            <label class="form-label">(Etudiant)</label>
            <select name="formation_id">
                <option value="0">--Choisissez une formation--</option>
                @foreach($formations as $formation)
                <option value="{{$formation->id}}">{{$formation->intitule}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary btn-ghost" type="submit">Register</button>
        @csrf
    </form>
</div>
@endsection