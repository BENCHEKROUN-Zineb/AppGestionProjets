@extends('layouts.sidebar')

@section('head-title')
    Services
@endsection 

@section('style')
    <style>
        .card-body {
            padding: 10px; /* Enlève le padding intérieur de la carte */
        }
    
        .card-body > * {
            margin-bottom: 1rem; /* Espacement entre les lignes */
        }
    
        .card-body > *:last-child {
            margin-bottom: 0; /* Enlève l'espacement après le dernier élément */
        }
    
        .btn-info {
            margin-left: auto; /* Aligne le bouton à droite */
            color: white;
            background-color: #54B1FC;
            border: none
        }
    
        .card {
            margin: 0 10px; /* Ajoute un espacement autour des cartes */
        }
    </style>
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Services</a>
    </li>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="container mt-3">
        <div class="row">
            <div id="search" class="d-flex justify-content-between align-items-center mb-3">
                <form action="{{ url('services') }}" method="GET" class="d-flex" style="flex-grow: 1; max-width: 400px;">
                    <div class="form-input" style="flex-grow: 1;">
                        <input type="search" name="query" placeholder="Chercher..." value="{{ request('query') }}">
                        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>                    
                    </div>
                </form>
                @can('ajouter service')
                    <a href="{{ url('services/create') }}" class="btn btn-primary">Ajouter Service</a>
                @endcan
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            @foreach ($services as $service)
                <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <div>
                                <h5 class="card-title">{{ $service->nomS }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $service->division->nomD }}</h6>
                            </div>
                            <a href="{{ route('services.show', $service->idS) }}" class="btn btn-info mt-auto">Voir plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
