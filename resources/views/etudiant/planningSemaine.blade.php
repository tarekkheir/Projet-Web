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
    @if(sizeof($plannings) == 0)
    <h3>Aucun cours</h3>
    @else
    <h3>Planning</h3>
    @foreach($plannings as $planning)
    <h5>Semaine du {{$dates[$planning[0]->id]}}</h5>
    <table class="table">
        <tr class="head">
            <th>Intitulé</th>
            <th>Date</th>
            <th>Heure</th>
        @foreach($planning as $p)
        </tr>
            <td class="cell">{{$p->cours()->get()[0]->intitule}}</td>
            <td class="cell">{{explode('UTC', $p->date_debut)[0]}}</td>
            <td class="cell">{{explode('UTC', $p->date_debut)[1]}}-{{explode('UTC', $p->date_fin)[1]}}</td>
        </tr>
        @endforeach
    </table><br><br>
    @endforeach
    @endif
</div>
@endsection