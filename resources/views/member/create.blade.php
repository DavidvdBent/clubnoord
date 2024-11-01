@extends('components.layout')

@section('content')
    <h1 class="header">Nieuw Lid Aanmaken</h1>
    <a href="{{url()->previous()}}"><i class="fa-solid fa-backward-step back-icon"></i></a>
    <form method="post" action="/member/store">
        @csrf

        <label for="naam">Volledige Naam</label><br>
        <input type="text" id="naam" name="naam" value="{{old('naam')}}"><br>
        @error('naam')
            <div class="error" style="color = 'red' ">{{ $message }}</div>
        @enderror

        <label for="type_member_id">Soort Lid</label><br>
        <select name="type_member_id" id="type_member_id">
            {{-- Loop door type leden en laat die in een dropdown zien (selecteer een oude keuze (van de user) als die er is) --}}
            @foreach ($typemembers as $typemember)
                @if (old('type_member_id') == $typemember->id)
                    <option value="{{$typemember->id}}" selected = 'true'>{{$typemember->soort_lid}}</option>   
                @else
                    <option value="{{$typemember->id}}">{{$typemember->soort_lid}}</option>
                @endif
            @endforeach
        </select><br>

        <label for="geboortedatum">Leeftijd:</label><br>
        <input type="date" id="geboortedatum" name="geboortedatum" value="{{old('geboortedatum')}}"><br><br>
        @error('geboortedatum')
            <div class="error">{{ $message }}</div>
        @enderror

        <div x-data="{ visible: true}">
            {{-- Selecteer een bestaande of nieuwe familie --}}
            <label for="family">Maakt deel uit van:</label><br>
            <input type="radio" id="nieuwe_familie" class="radio" name="familie_check" value="new" checked="checked" x-on:click="visible = !visible">
            <label for="fam" class="radio">Een Nieuwe Familie</label><br>
            <input type="radio" id="bestaande_familie" name="familie_check" class="radio" value="exist" x-on:click="visible = !visible">
            <label for="html" class="radio">Een Bestaande Familie</label><br>
            
            {{-- Laat zien als nieuwe familie is geselecteerd --}}
            <div x-show="visible">
                <p class="dropdown-title">Een nieuwe familie toevoegen</p>
                <label for="fam_naam">Achternaam</label><br>
                <input type="text" id="fam_naam" name="fam_naam" value="{{old('fam_naam')}}"><br>
                @error('fam_naam')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="straatnaam">Straatnaam</label><br>
                <input type="text" id="straatnaam" name="straatnaam" value="{{old('straatnaam')}}"><br>
                @error('straatnaam')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="huisnummer">Huisnummer</label><br>
                <input type="number" id="huisnummer" name="huisnummer" value="{{old('huisnummer')}}"><br>
                @error('huisnummer')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="toevoeging">Toevoeging</label><br>
                <input type="text" id="toevoeging" name="toevoeging" value="{{old('toevoeging')}}"><br>
                @error('toevoeging')
                    <div class="error">{{ 'Dit adres is al in gebruik' }}</div>
                @enderror
                <label for="postcode">Postcode</label><br>
                <input type="text" id="postcode" name="postcode" value="{{old('postcode')}}"><br>
                @error('postcode')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>
            <div x-show="!visible">
                {{-- Laat zien als bestaande familie is geselecteerd --}}
                <label for="family" class="dropdown-title">Selecteer hier de Familie</label><br>
                <select name="family_id" id="family_id">
                {{-- Toon de oude geselecteerde waarde (familie) van de user als die er is --}}
                @foreach ($families as $family)
                    @if (old('family_id') == $family->id)
                        <option value="{{$family->id}}" selected = 'true' name="family_id">{{$family->fam_naam}}</option>   
                    @else
                        <option value="{{$family->id}}" name="family_id" >{{$family->fam_naam}}</option>
                    @endif
                @endforeach
                </select>
            </div>
        </div>
        <input type="submit" value="Lid aanmaken">
    </form> 
@endsection