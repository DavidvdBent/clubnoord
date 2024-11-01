@extends('components.layout')

@section('content')
    <h1 class="header">Familie: {{$family->fam_naam}} bewerken</h1>
    <a href="{{url()->previous()}}"><i class="fa-solid fa-backward-step back-icon"></i></a>
    {{-- Formulier voor het wijzigen van gegeven Familie --}}
    <form method="post" action="/family/update/{{$family->id}}">
        @method('PATCH')
        @csrf
        
        <label for="fam_naam">Achternaam</label><br>
        <input type="text" id="fam_naam" name="fam_naam" value="{{$family->fam_naam}}"><br>
        @error('fam_naam')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="straatnaam">Straatnaam</label><br>
        <input type="text" id="straatnaam" name="straatnaam" value="{{$family->adress->straatnaam}}"><br>
        @error('straatnaam')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="huisnummer">Huisnummer</label><br>
        <input type="number" id="huisnummer" name="huisnummer" value="{{$family->adress->huisnummer}}"><br>
        @error('huisnummer')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="toevoeging">Toevoeging</label><br>
        <input type="text" id="toevoeging" name="toevoeging" value="{{$family->adress->toevoeging}}"><br>
        @error('toevoeging')
            <div class="error">{{ $message }}</div>
        @enderror
        
        <label for="postcode">Postcode</label><br>
        <input type="text" id="postcode" name="postcode" value="{{$family->adress->postcode}}"><br>
        @error('postcode')
        <div class="error">{{ $message }}</div>
        @enderror

        <br>
        <input type="submit" value="Familie Wijzigen">
    </form> 
@endsection