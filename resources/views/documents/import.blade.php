@extends('layouts.sidebar')

@section('head-title')
    Ajouter Document
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Documents</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Ajouter Document</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('documents') }}" class="btn btn-primary">Retour</a>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('documents.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="redirectTo" value="documents.index">
            <div class="mb-3">
                <label for="nomD" class="form-label">Nom du Document</label>
                <input type="text" name="nomD" class="form-control" id="nomD" required>
            </div>
            <div class="mb-3">
                <label for="typeD" class="form-label">Type du Document</label>
                <input type="text" name="typeD" class="form-control" id="typeD" value="Excel" required>
            </div>
            <div class="mb-3">
                <label for="idP" class="form-label">Nom du Projet</label>
                <div class="mb-3">
                    <select name="idP" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Choisissez un Projet</option>
                        @foreach($projets as $projet)
                            <option value="{{ $projet->idP }}">{{ $projet->nomP }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="excel_file" class="form-label">Importer le fichier Excel</label>
                <input type="file" name="excel_file" class="form-control" id="excel_file" required>
            </div>
            <button type="submit" class="btn btn-primary">Importer</button>
        </form>
    </div>
@endsection
