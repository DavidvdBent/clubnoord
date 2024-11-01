@extends('components.layout')
@section('content')
    <h1 class="header"> Typelid: {{$typemember->soort_lid}} bewerken </h1>
    <a href="{{url()->previous()}}"><i class="fa-solid fa-backward-step back-icon"></i></a>
    {{-- Formulier om het huidige type lid aan te passen --}}
    <form method="post" action="/typemember/update/{{$typemember->id}}">
        @method('PATCH')
        @csrf

        <label for="soort_lid">Type Lid Naam</label><br>
        <input type="text" id="soort_lid" name="soort_lid" value="{{$typemember->soort_lid}}"><br>
        @error('soort_lid')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="omschrijving">Omschrijving</label><br>
        <input type="text" id="omschrijving" name="omschrijving" value="{{$typemember->omschrijving}}"><br>
        @error('omschrijving')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="korting">korting</label><br>
        <input type="number" id="korting" name="korting" value="{{$typemember->korting}}"><br>
        @error('korting')
            <div class="error">{{ $message }}</div>
        @enderror

        <br>
        <input type="submit" value="Submit">
    </form> 
@endsection