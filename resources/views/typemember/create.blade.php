@extends('components.layout')

@section('content')
    <h1 class="header"> Nieuw type lid aanmaken </h1 class="header">
    <a href="{{url()->previous()}}"><i class="fa-solid fa-backward-step back-icon"></i></a>
    {{-- Formulier om een nieuwe type lid aan te maken --}}
    <form method="post" action="/typemember/store">
        @csrf
        <label for="soort_lid">Type Lid Naam</label><br>
        <input type="text" id="soort_lid" name="soort_lid" value="{{old('soort_lid')}}"><br>
        @error('soort_lid')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="omschrijving">Omschrijving (max:25 tekens)</label><br>
        <input type="text" id="omschrijving" name="omschrijving" value="{{old('omschrijving')}}"><br>
        @error('omschrijving')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="korting">korting</label><br>
        <input type="number" id="korting" name="korting" value="old('korting')"><br>
        @error('korting')
            <div class="error">{{ $message }}</div>
        @enderror

        <br>
        <input type="submit" value="Submit">
    </form> 
@endsection