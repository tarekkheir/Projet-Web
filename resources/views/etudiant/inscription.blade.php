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
            <h4>S'inscrire à un cours {{auth()->user()->formation()->get()[0]->intitule}}</h4>
            <div class="form-group">
                <select name="cours_id">
                    <option value="0">--Choisissez un cours--</option>
                    @foreach($cours as $cour)
                    <option value="{{$cour->id}}">{{$cour->intitule}}</option>
                    @endforeach
                </select>
            </div>
             <button class="btn btn-primary btn-ghost" type="submit">S'inscrire</button>
            @csrf
        </form>
    </div>
</div>
@endsection