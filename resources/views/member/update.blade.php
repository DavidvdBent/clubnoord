@extends('components.layout')

@section('content')
    <h2> Lid {{$member->naam}} bewerken </h2>
    <a href="{{url()->previous()}}"><i class="fa-solid fa-backward-step back-icon"></i></a>
    {{-- formulier voor het bewerken van het huidige lid --}}
    <form method="post" action="/member/update/{{$member->id}}">
        @method('PATCH')
        @csrf

        <label for="naam">Volledige Naam</label><br>
        <input type="text" id="naam" name="naam" value="{{$member->naam}}"><br>
        @error('naam')
            <div class="error" style="color = 'red' ">{{ $message }}</div>
        @enderror
        
        {{-- Loop door type leden en laat die in een dropdown zien (selecteer het huidige type lid van dit lid) --}}
        <label for="type_member_id">Soort Lid</label><br>
        <select name="type_member_id" id="type_member_id">
        @foreach ($typemembers as $typemember)
            @if ($typemember->id == $member->type_member_id)
                <option value="{{$typemember->id}}" selected="true">{{$typemember->soort_lid}}</option>
            @else
                <option value="{{$typemember->id}}">{{$typemember->soort_lid}}</option>
            @endif
        @endforeach
        </select><br>
        
        <label for="geboortedatum">Leeftijd:</label><br>
        <input type="date" id="geboortedatum" name="geboortedatum" value="{{$member->geboortedatum}}"><br><br>
        @error('geboortedatum')
            <div class="error">{{ $message }}</div>
        @enderror

        <div x-data="{ visible: true}">
            {{-- Selecteer een bestaande of nieuwe familie --}}
            <label for="family">Maakt deel uit van:</label><br>
            {{-- Als de user het lid het gewijzigd naar nieuwe familie (maar nog niet door validation is heen gekomen--}}
            @if (old("familie_check") == "new")
                <input type="radio" class="radio" id="nieuwe_familie" name="familie_check" checked="checked" value="new" x-on:click="visible = !visible">
                <label for="fam" class="radio" >Een Nieuwe Familie</label><br>
                <input type="radio" id="bestaande_familie" class="radio" name="familie_check" value="exist" x-on:click="visible = !visible">
                <label for="html" class="radio radio-bottom">Een Bestaande Familie</label><br>
                <div x-show="visible"> 
            {{-- het lid heeft een bestaande familie--}}
            @else
                <input type="radio" class="radio" id="nieuwe_familie" name="familie_check" value="new" x-on:click="visible = !visible">
                <label for="fam" class="radio" >Een Nieuwe Familie</label><br>
                <input type="radio" id="bestaande_familie" class="radio" name="familie_check" checked="checked" value="exist" x-on:click="visible = !visible">
                <label for="html" class="radio radio-bottom">Een Bestaande Familie</label><br>
                <div x-show="!visible"> 
            @endif
                    {{-- Een nieuwe familie toevoegen --}}
                    <h3>Een Nieuwe Familie Toevoegen</h3>

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

                    <label for="postcode">Postcode</label><br>
                    <input type="text" id="postcode" name="postcode" value="{{old('postcode')}}"><br>
                    @error('postcode')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    <label for="toevoeging">Toevoeging</label><br>
                    <input type="text" id="toevoeging" name="toevoeging" value="{{old('toevoeging')}}"><br>
                    {{-- Als het adres al gebruikt is krijgt de toevoeging de error --}}
                    @error('toevoeging')
                        <div class="error">{{ 'Dit adres is al in gebruik'}}</div>
                    @enderror
                </div>

                {{-- Laat de bestaande dropdown alleen zien als de user niet een nieuwe familie heeft aangevinkt --}}
                @if (old("familie_check") == "new")
                    <div x-show="!visible">
                @else
                    <div x-show="visible">
                @endif
                        {{-- Lid heeft een bestaande familie --}}
                        <label for="family" class="dropdown-title">Selecteer hier de Familie</label><br>
                        <select name="family_id" id="family_id">
                            {{-- Loop door alle families  en selecteer de huidige familie van het lid --}}
                            @foreach ($families as $family)
                                @if (old('family_id') == $family->id || $member->family_id == $family->id)
                                    <option value="{{$family->id}}" selected = 'true' name="family_id">{{$family->fam_naam}}</option>   
                                @else
                                    <option value="{{$family->id}}" name="family_id" >{{$family->fam_naam}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                 <input type="submit" value="Lid bewerken">
            </div>
        </div>
    </form> 
@endsection