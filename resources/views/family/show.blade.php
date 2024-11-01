@extends('components.layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <h1 class="header"> Familie: {{$family->fam_naam}}</h1>
    <div class="content-show">
        <h4 class="data-label"> Naam </h4>
        <p class="data-show">{{$family->fam_naam}}</p>
        <h4 class="data-label"> Adres</h4>
        <p class="data-show">{{$family->adress->straatnaam}}, {{$family->adress->huisnummer}}, {{$family->adress->toevoeging}}, {{$family->adress->postcode}}</p>    
        <h4 class="data-label"> Aantal Leden</h4>
        <p class="data-show">{{$family->members->count()}}</p>    
        <h4 class="data-label"> Totale Contributie</h4>
        <p class="data-show">€{{$family->getSumContribution($family)}}</p> 
        <div class="alt-icons">
            {{-- Link naar het wijzigen van huidige familie --}}
            <a href="/family/update/{{$family->id}}"><i class="fa-regular fa-pen-to-square data-icons"></i></a>
            {{-- Form Request om de huidige familie te verwijderen--}}
            <form class="del-form" method="POST" action="/family/{{$family->id}}">
                @csrf
                @method('DELETE')
                <button class="del-button"><i class="fa-solid fa-trash data-icons"></i></button>
            </form>
        </div>
    </div>                    
    <h2 class="heading-two">Leden van Familie: {{$family->fam_naam}}</h2>
    <div class="content-list">
        <table class="responsive-table">
          <tr class="table-header">
            <th>Lid ID</th>
            <th>Naam</th>
            <th>Familie Naam</th>
            <th>Soort Lid</th>
            <th>Leeftijd Lid</th>
            <th>Contributie</th>
            <th>Edit/Delete</th>
          </tr>
          {{-- Alle leden van de huidige familie apart tonen in een tabel --}}
            @foreach ($family->members as $member)
                <tr class=table-row>
                    <td>{{$member->id}}</td>
                    <td><a href='/member/{{$member->id}}'>{{$member->naam}}</a></td>
                    <td><a href='/family/{{$member->family->id}}'>{{$member->family->fam_naam}}</a></td>
                    <td>{{$member->type_member->soort_lid}}</td>
                    <td>{{$agetype = $member->getContributionType($member)}}</td>
                    <td>€{{$member->getContribution($agetype, $member)}}</td>
                    <td>
                        <div class="alt-icons-index">
                        {{-- Link naar het wijzigen van het huidige lid --}}
                        <a href="/member/update/{{$member->id}}"><i class="fa-regular fa-pen-to-square alt-icon-index"></i></a>
                        {{-- Form Request om het huidige lid te verwijderen--}}
                        <form class="del-form" method="POST" action="/member/{{$member->id}}">
                            @csrf
                            @method('DELETE')
                            <button class="del-button"><i class="fa-solid fa-trash alt-icon-index"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection