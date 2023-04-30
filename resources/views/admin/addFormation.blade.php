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
            <h1>Ajouter une formation</h1>
            <div class="form-group">
                <label class="form-label">Intitule</label>
                <input class="form-field" type="text" name="intitule" value="{{old('intitule')}}">
            </div>
             <button class="btn btn-primary btn-ghost" type="submit">Envoyer</button>
            @csrf
        </form>
    </div>
</div>
@endsection