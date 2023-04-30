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
            <h1>Ajouter une séance</h1>
            <div class="form-group">
                <select name="cours_id">
                    <option value="">--Choisissez un cours--</option>
                    @foreach($cours as $cour)
                    <option value="{{$cour->id}}">{{$cour->intitule}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="meeting-time">Debut:</label>
                <input type="datetime-local" name="date_debut" value=""
                        min="2023-04-29T00:00" max="2024-04-29T00:00">
            </div> 
            <div class="form-group">
                <label for="meeting-time">Fin:</label>
                <input type="datetime-local" name="date_fin" value=""
                        min="2023-04-29T00:00" max="2024-04-29T00:00">
            </div>
            <button class="btn btn-primary btn-ghost" type="submit">Envoyer</button>
            @csrf
        </form>
    </div>
</div>
@endsection