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
    @if(empty(sizeof($plannings)))
    <h3>Aucun cours</h3>
    @else
    <h3>Planning</h3>
    <table class="table">
        <tr class="head">
            <th>Intitulé</th>
            <th>Date</th>
            <th>Heure</th>
        </tr>
        @foreach($plannings as $planning)
        <tr>
            <td class="cell">{{$planning->cours()->get()[0]->intitule}}</td>
            <td class="cell">{{explode('UTC', $planning->date_debut)[0]}}</td>
            <td class="cell">{{explode('UTC', $planning->date_debut)[1]}}-{{explode('UTC', $planning->date_fin)[1]}}</td>
        </tr>
        @endforeach
    </table>
    @endif
</div>
@endsection