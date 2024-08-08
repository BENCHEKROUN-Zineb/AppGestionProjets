@extends('layouts.sidebar')

@section('head-title')
    Ajouter Division
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Divisions</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Ajouter Division</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('divisions') }}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ url('divisions') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="">Nom Division :</label>
            <input type="text" name="nomD" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
@endsection 