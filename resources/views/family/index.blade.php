@extends('components.layout')

@section('content')
  <h1 class="header"> Families</h1>
  <div class="content-list">
      <table class="responsive-table">
        <tr class="table-header">
          <th>Familie ID</th>
          <th>Naam</th>
          <th>Postcode</th>
          <th>Aantal Leden</th>
          <th>Totale Contributie</th>
          <th>Edit/Delete</th>
        </tr>
        {{-- Over alle families loopen en de data van elke familie apart weergeven in de tabel --}}
        @foreach ($families as $family)
          <tr class=table-row>
              <td><a href='/family/{{$family->id}}'>{{$family->id}}</a></td>
              <td><a href='/family/{{$family->id}}'>{{$family->fam_naam}}</a></td>
              <td><a href='/family/{{$family->id}}'>{{$family->adress->postcode}}</a></td>
              <td><a href='/family/{{$family->id}}'>{{$family->members->count()}}</a></td>
              <td>€{{$family->getSumContribution($family)}}</td>
              <td>
                <div class="alt-icons-index">
                  {{-- Link naar het wijzigen van specifieke familie --}}
                  <a href="/family/update/{{$family->id}}"><i class="fa-regular fa-pen-to-square alt-icon-index"></i></a>
                  {{-- Form Request om de specifieke familie te verwijderen--}}
                  <form class="del-form" method="POST" action="/family/{{$family->id}}">
                      @csrf
                      @method('DELETE')
                      <button class="del-button"><i class="fa-solid fa-trash alt-icon-index"></i></button>
                  </form>
                </div>
              </td>
          </tr>
        @endforeach
      </table>
      {{ $families->links() }}
    </div>
@endsection
