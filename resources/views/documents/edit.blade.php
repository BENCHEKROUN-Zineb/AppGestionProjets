@extends('layouts.sidebar')

@section('head-title')
    Modifier Document
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a href="{{ route('documents.index') }}">Documents</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">{{ $document->nomD }}</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ route('documents.index') }}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ route('documents.update', $document->idD) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="nomD" class="form-label">Nom du Document :</label>
            <input type="text" name="nomD" value="{{ $document->nomD }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="typeD" class="form-label">Type Document :</label>
            <textarea name="typeD" class="form-control" cols="30" rows="5" required>{{ $document->typeD }}</textarea>
        </div>

        <div class="mb-3">
            <label for="idP" class="form-label">Nom du Projet</label>
            <select name="idP" class="form-select" required>
                @foreach($projets as $projet)
                    <option value="{{ $projet->idP }}" {{ $document->idP == $projet->idP ? 'selected' : '' }}>{{ $projet->nomP }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="excel_file" class="form-label">Importer le fichier Excel</label>
            <input type="file" name="excel_file" class="form-control" id="excel_file">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
@endsection
