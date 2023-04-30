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
        <form method="post" class="form" action="{{route('enseignant.modifier', ['id' => $planning->id])}}">
            @method('put')
            <h1>Modifier la séance</h1>
            <div class="form-group">
                <label for="meeting-time">Debut:</label>
                <input type="datetime-local" name="date_debut" value="{{$planning->date_debut}}"
                        min="2023-04-29T00:00" max="2024-04-29T00:00">
            </div> 
            <div class="form-group">
                <label for="meeting-time">Fin:</label>
                <input type="datetime-local" name="date_fin" value="{{$planning->date_fin}}"
                        min="2023-04-29T00:00" max="2024-04-29T00:00">
            </div>
            <button class="btn btn-primary btn-ghost" type="submit">Envoyer</button>
            @csrf
        </form>
    </div>
</div>
@endsection