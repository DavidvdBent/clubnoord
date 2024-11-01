@extends('components.layout')

@section('content')
    <h1 class="header"> Lid: {{$member->naam}}</h1>
    {{-- Toon data van het gegeven lid --}}
    <div class="content-show">
        <h4 class="data-label"> Naam </h4>
        <p class="data-show">{{$member->naam}}</p>
        <h4 class="data-label"> Familie naam </h4>
        <p class="data-show"><a href='/family/{{$member->family->id}}'>{{$member->family->fam_naam}}</a></p>
        <h4 class="data-label"> Adres</h4>
        <p class="data-show">{{$member->family->adress->straatnaam}}, {{$member->family->adress->huisnummer}}, {{$member->family->adress->toevoeging}}, {{$member->family->adress->postcode}}</p>    
        <h4 class="data-label">Soort Lid</h4>
        <p class="data-show">{{$member->type_member->soort_lid}}</p>    
        <h4 class="data-label">Geboortedatum</h4>
        <p class="data-show">{{$member->geboortedatum}}</p>
        <h4 class="data-label">Leeftijd type</h4>
        <p class="data-show">{{$agetype = $member->getContributionType($member)}}</p> 
        <h4 class="data-label">Contributie</h4>
        <p class="data-show">€{{$member->getContribution($agetype, $member)}},-</p>  
        <div class="alt-icons">
            {{-- link naar het bewerken van gegeven lid --}}
            <a href="/member/update/{{$member->id}}"><i class="fa-regular fa-pen-to-square data-icons"></i></a>
            {{-- request van het verwijderen van gegeven lid --}}
            <form class="del-form" method="POST" action="/member/{{$member->id}}">
                @csrf
                @method('DELETE')
                <button class="del-button"><i class="fa-solid fa-trash data-icons"></i></button>
            </form>
        </div>
    </div>     
@endsection