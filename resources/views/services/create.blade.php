@extends('layouts.sidebar')

@section('head-title')
    Ajouter Service
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Services</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Ajouter Service</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('services') }}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ url('services') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="">Nom Service :</label>
            <input type="text" name="nomS" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="">Description Service :</label>
            <textarea name="descriptionS" class="form-control" cols="30" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="">Division :</label>
            <select name="idD" class="form-select" aria-label="Default select example" required>
                <option selected value="">Choisissez une division</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->idD }}">{{ $division->nomD }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
        
    </form>
@endsection
