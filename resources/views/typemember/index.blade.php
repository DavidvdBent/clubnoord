@extends('components.layout')

@section('content')
<h1 class="header">Soort Leden</h1>
<div class="content-list">
    <table class="responsive-table">
        <tr class="table-header">
            <th>Soort Lid</th>
            <th>Omschrijving</th>
            <th>Korting</th>
            <th>Aantal Leden</th>
            <th>Edit/Delete</th>
        </tr>
        @foreach ($typemembers as $typemember)
            <tr class=table-row>
                <td>{{$typemember->soort_lid}}</td>
                <td>{{$typemember->omschrijving}}</td>
                <td>{{$typemember->korting}} %</td>
                <td>{{$typemember->members->count()}}</td>
                <td>
                    <div class="alt-icons-index">
                    {{-- Link om type lid te bewerken--}}
                    <a href="/typemember/edit/{{$typemember->id}}"><i class="fa-regular fa-pen-to-square alt-icon-index"></i></a>
                    {{-- Form request om type lid te verwijderen--}}
                    <form class="del-form" method="POST" action="/typemember/{{$typemember->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="del-button"><i class="fa-solid fa-trash alt-icon-index"></i></button>
                    </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    {{-- Print errors hier --}}
    @if($errors->any())
        <h4 class="error">{{$errors->first()}}</h4>
    @endif
    {{-- Link naar een nieuw type lid aanmaken --}}
    <div class="type-add">
        <a href="/typemember/create"><p> <i class="fa-solid fa-plus"></i> Een Nieuw Type Lid Aanmaken </p><a>
    </div>
@endsection
