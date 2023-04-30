@extends('modele.main')

@section('contents')
<div class="commandes">
    @if($errors->any())
    @foreach($errors->all() as $e)
    <br>{{$e}}<br>
    @endforeach
    @endif
    @if(empty($cours[0]))
    <h4>Aucun cours</h4>
    @else
    <h3>Choisissez un cours</h3>
    <ul>
        @foreach($cours as $cour)
        <li>
            <form method="GET" action="{{route('etudiant.planningCours', ['id' => $cour->id])}}">
                <button type="submit" name="cours_id">{{$cour->intitule}}</button>
                @csrf
            </form>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection