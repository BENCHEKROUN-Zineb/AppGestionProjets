@extends('layouts.sidebar')

@section('head-title')
    Modifier Projet
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a href="#">Services</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Modifier Projet : {{ $projet->nomP }}</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('projets') }}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ url('projets/'.$projet->idP) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="">Nom Projet :</label>
            <input type="text" name="nomP" value="{{ $projet->nomP }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="">Description Projet :</label>
            <textarea name="descriptionP" class="form-control" cols="30" rows="5" required>{{ $projet->descriptionP }}</textarea>
        </div>

        <div class="mb-3">
            <label for="">Service :</label>
            <select name="idS" class="form-select" aria-label="Default select example" required>
                <option selected value="">Choisissez une division</option>
                @foreach($services as $service)
                    <option value="{{ $service->idS }}" {{ $projet->idS == $service->idS ? 'selected' : '' }}>{{ $service->nomS }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="">Partenaires :</label>
            <div class="form-check">
                @foreach($partenaires as $partenaire)
                    <input 
                        type="checkbox" 
                        name="idpa[]" 
                        value="{{ $partenaire->idpa }}"
                        id="partenaire_{{ $partenaire->idpa }}"
                        class="form-check-input"
                        {{ $projet->partenaires->contains($partenaire->idpa) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="partenaire_{{ $partenaire->idpa }}">
                        {{ $partenaire->nomPa }}
                    </label><br>
                @endforeach
            </div>
            @error('idpa')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
@endsection
