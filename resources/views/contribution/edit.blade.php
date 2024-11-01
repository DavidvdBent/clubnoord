@extends('components.layout')

@section('content')

    <h1 class=header> Contributie Wijzigen </h1>
    <a href="{{url()->previous()}}"><i class="fa-solid fa-backward-step back-icon"></i></a>
    {{-- Gegeven Contributie/korting wijzigen  --}}
    <form method="post" action="/contribution/update/{{$contribution->id}}">
        @method('PATCH')
        @csrf
        <label for="leeftijd_korting" class="label-korting">{{$contribution->leeftijd}} korting:</label><br>
        <input type="number" id="leeftijd_korting" name="leeftijd_korting" value="{{$contribution->leeftijd_korting}}"><br>
        @error('leeftijd_korting')
            <div class="error">{{ $message}}</div>
        @enderror
        <br>
        <input type="submit" value="Korting Wijzigen">
    </form> 
@endsection
