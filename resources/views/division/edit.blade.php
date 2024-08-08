@extends('layouts.sidebar')

@section('head-title')
    Modifier Division
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a href="#">Divisions</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Modifier Division : {{ $division->nomD }}</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('divisions') }}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ url('divisions/'.$division->idD) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="">Nom Division :</label>
            <input type="text" name="nomD" value="{{ $division->nomD }}" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
@endsection 