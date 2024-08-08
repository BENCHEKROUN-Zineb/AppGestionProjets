@extends('layouts.sidebar')

@section('head-title')
    Ajouter Partenaire
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Partenaires</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Ajouter Partenaire</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('partenaires') }}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ url('partenaires') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="">Nom partenaire :</label>
            <input type="text" name="nomPa" class="form-control">
        </div>

        <div class="mb-3">
            <label for="">Contact Partenaire :</label>
            <input type="text" name="contactPa" class="form-control">
        </div>

        <div class="mb-3">
            <label for="">Adresse Partenaire :</label>
            <input type="text" name="adressePa" class="form-control">
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
@endsection 