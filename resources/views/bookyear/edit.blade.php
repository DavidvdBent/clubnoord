@extends('components.layout')

@section('content')
    <h1 class="header"> Basis Contributie Wijzigen </h1>
    {{-- Formulier om basis contributie te wijzigen --}}
    <form method="post" action="/bookyear/update/{{$bookyear->id}}">
        @method('PATCH')
        @csrf
        <label for="basis_contributie">Basis Contributie</label><br>
        <input type="number" id="basis_contributie" name="basis_contributie" value="{{$bookyear->basis_contributie}}"><br>
        @error('basis_contributie')
            <div class="error">{{ $message}}</div>
        @enderror
        <br>
        <input type="submit" value="Basis Contributie Wijzigen">
    </form> 
@endsection