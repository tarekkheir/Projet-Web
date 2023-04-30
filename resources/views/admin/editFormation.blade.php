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
        <form method="post" class="form" action="{{route('admin.modifierFormation', ['id' => $formation->id])}}">
            @method('put')
            <h1>Modifier la formation</h1>
            <div class="form-group">
                <label for="meeting-time">Intitule</label>
                <input type="text" name="intitule" value="{{$formation->intitule}}">
            </div>
            <button class="btn btn-primary btn-ghost" type="submit">Envoyer</button>
            @csrf
        </form>
    </div>
</div>
@endsection