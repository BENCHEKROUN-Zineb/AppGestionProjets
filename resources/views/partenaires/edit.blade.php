@extends('layouts.sidebar')

@section('head-title')
    Modifier Partenaire
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a href="#">Partenaires</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Modifier Partenaire : {{ $partenaire->nomPa }}</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('partenaires') }}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ url('partenaires/'.$partenaire->idpa) }}" method="POST">
        @csrf
        @method('PUT')
        
            <div class="mb-3">
                <label for="">Nom Partenaire :</label>
                <input type="text" name="nomPa" value="{{ $partenaire->nomPa }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="">Contact  Partenaire :</label>
                <input type="text" name="contactPa" value="{{ $partenaire->contactPa }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="">Adresse  Partenaire :</label>
                <input type="text" name="adressePa" value="{{ $partenaire->adressePa }}" class="form-control">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>

    </form>
@endsection 