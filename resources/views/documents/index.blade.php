@extends('layouts.sidebar')

@section('head-title')
    Documents
@endsection 

@section('style')
    
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Documents</a>
    </li>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @can('ajouter document')
        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="{{ url('documents/create') }}" class="btn btn-primary">Ajouter Document</a>
        </div>
    @endcan

    <div class="d-flex justify-content-center mt-2">
        <table id="myTable" class="table table-hover align-middle" style="width:100%; ">
            <thead class="table-light">
                <tr>
                    <th>Nom Document</th>
                    <th>Type</th>
                    <th>Nom Projet</th>
                    <th style="width: 30%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>{{ $document->nomD }}</td>
                        <td>{{ $document->typeD }}</td>
                        <td>{{ $document->projet ? $document->projet->nomP : 'N/A' }}</td>
                        <td style="width: 50%">
                            {{-- <a href="{{ route('documents.show', $document->idD) }}" class="btn btn-info">Show</a> --}}
                            @can('modifier document')
                                <a href="{{ route('documents.edit', $document->idD) }}" class="btn btn-outline-success">Modifier</a>
                            @endcan
                            @can('supprimer document')
                                <form action="{{ route('documents.destroy', $document->idD) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                                </form>
                            @endcan
                            @can('téléchargez document')
                                <a href="{{ route('documents.download', $document->idD) }}" class="btn btn-outline-info">Télécharger</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection