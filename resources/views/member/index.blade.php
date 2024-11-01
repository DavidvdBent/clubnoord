@extends('components.layout')

@section('content')
  <h1 class="header">Leden</h1>
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
      @foreach ($members as $member)
        <tr class=table-row>
          <td><a href='/member/{{$member->id}}'>{{$member->id}}</a></td>
          <td><a href='/member/{{$member->id}}'>{{$member->naam}}</a></td>
          <td><a href='/family/{{$member->family->id}}'>{{$member->family->fam_naam}}</a></td>
          <td><a href='/typemembers'>{{$member->type_member->soort_lid}}</a></td>
          <td><a href='/contributies'>{{$agetype = $member->getContributionType($member)}}</a></td>
          <td>€{{$member->getContribution($agetype, $member)}}</td>
          <td>
            <div class="alt-icons-index">
              {{-- Link om lid te bewerken--}}
              <a href="/member/update/{{$member->id}}"><i class="fa-regular fa-pen-to-square alt-icon-index"></i></a>
              {{-- Form Request om lid te verwijderen--}}
              <form class="del-form" method="POST" action="/member/{{$member->id}}">
                  @csrf
                  @method('DELETE')
                  <button class="del-button"><i class="fa-solid fa-trash alt-icon-index"></i></button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </table>
    {{-- Paginate members --}}
    {{ $members->links() }}
    <div class="type-add">
      <a href="/member/create"><p> <i class="fa-solid fa-plus"></i> Een Nieuw Lid Aanmaken </p><a>
    </div>
@endsection
