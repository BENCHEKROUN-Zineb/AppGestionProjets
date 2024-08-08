{{-- @extends('layouts.sidebar')

@section('content')
<div class="container">
    <form action="{{ route('documents.search') }}" method="GET">
        <div class="form-row d-flex justify-content-start align-items-center mb-3 ">
            <div class="col-6 mx-1">
                <input type="text" name="query" class="form-control" placeholder="Rechercher">
            </div>
            <div class="col-4 mx-1">
                <select name="file_filter" id="file_filter" class="form-control">
                    <option value="">Tous les fichiers</option>
                    @foreach($allDocuments as $document)
                        <option value="{{ $document->idD }}">{{ $document->nomD }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2 ms-4">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </div>
    </form>
    
    @if(isset($results))
        <h2>Résultats de recherche</h2>
        <p>Total des résultats : {{ $totalResults }}</p>
        
        @if($totalResults > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Valeur</th>
                        <th>Nom du fichier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result['value'] }}</td>
                            <td>{{ $result['file_name'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucun résultat trouvé.</p>
        @endif
    @endif
</div>
@endsection --}}


@extends('layouts.sidebar')

@section('head-title')
    Recherche
@endsection 

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Recherche</a>
    </li>
@endsection

@section('content')
<div class="container">
    <form action="{{ route('documents.search') }}" method="GET">
        <div class="form-row d-flex justify-content-start align-items-center mb-3">
            <div class="col-6 mx-1">
                <input type="text" name="query" class="form-control" placeholder="Rechercher">
            </div>
            <div class="col-4 mx-1">
                <select name="file_filter" id="file_filter" class="form-control">
                    <option value="">Selectionnez un fichier</option>
                    @foreach($allDocuments as $document)
                        <option value="{{ $document->idD }}">{{ $document->nomD }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2 ms-4">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </div>
    </form>

    @if(isset($results))
    <h4 class="text-center">Résultats de recherche</h4>
    @foreach($results as $fileName => $rows)
        <span> Le fichier : <span class="badge rounded-pill text-bg-secondary mb-2">{{ $fileName }}</span></span>
        @if(count($rows) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!-- Utiliser for pour générer les en-têtes -->
                        @if (count($rows) > 0)
                            @php $firstRow = $rows[0]->toArray(); @endphp
                            @for ($i = 0; $i < count(array_keys($firstRow)); $i++)
                                <th>Colonne {{$i+1}}</th>
                            @endfor
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        <tr>
                            @php $rowArray = $row->toArray(); @endphp
                            @for ($i = 0; $i < count(array_keys($rowArray)); $i++)
                                <td>{{ $rowArray[array_keys($rowArray)[$i]] }}</td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucune donnée trouvée dans ce fichier.</p>
        @endif
    @endforeach
    @endif
</div>
@endsection





