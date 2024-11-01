@extends('components.layout')

@section('content')
    <h1 class="header"> Contributies</h1>
    <div class="content-show">
        <h4 class="data-label">Basis Contributie:</h4>
        <p class="data-show">€{{$bookyears->find(3)->basis_contributie}}</p> 
        <h4 class="data-label">Totale Contributie (Verwacht)</h4>
        <p class="data-show">€{{$contributions->first()->getTotalContribution()}}</p> 
        <a href="/boekjaar/edit/{{$contributions->first()->bookyear->id}}"><i class="fa-regular fa-pen-to-square data-icons"></i></a>
    </div>     
    <h2 class="heading-two">Leeftijd Kortingen</h2>
    <div class="content-list">
        <table class="responsive-table">
            <tr class="table-header">
                <th>Leeftijd</th>
                <th>Korting</th>
                <th>Edit</th> 
            </tr>
            {{-- over alle contributies loopen en ze data weergeven in de tabel --}}
            @foreach ($contributions as $contribution)
                <tr class=table-row>
                    <td>{{$contribution->leeftijd}}</td>
                    <td>{{$contribution->leeftijd_korting}} %</td>
                    <td><a href="/contribution/edit/{{$contribution->id}}"><i class="fa-regular fa-pen-to-square"></i></a></td>
                </tr>
            @endforeach
        </table>
    </div>

    <h2 class="heading-two">Boekjaren</h2>
    <div class="content-list">
        <table class="responsive-table">
            <tr class="table-header">
                <th>ID</th>
                <th>Boekjaar</th>
                <th>Basis Contributie</th>
            </tr>
            {{-- over alle boekjaren loopen en weergeven in de tabel --}}
            @foreach ($bookyears as $bookyear)
                <tr class=table-row>
                    <td>{{$bookyear->id}}</td>
                    <td>{{$bookyear->boekjaar}}</td>
                    <td>€{{$bookyear->basis_contributie}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    
@endsection
