@extends('layouts.sidebar')

@php
    use Carbon\Carbon;
@endphp

@section('head-title')
    Details Services
@endsection 

@section('style')
    <style>
        .btn-container {
            display: flex;
            justify-content: flex-end; /* Aligne les boutons à droite */
            gap: 10px; /* Ajoute un espacement entre les boutons */
        }
    </style>
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a href="#">Projets</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Details Projets</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('services') }}" class="btn btn-primary">Retour</a>
    </div>

    <div class="container">
        <div class="row mx-4">
            <div class="card p-0">
                <div class="card-header">
                    <h5>{{ $service->nomS }}</h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $service->division->nomD }}</h6>
                    <p class="card-text">{{ $service->descriptionS }}</p>
                    <div class="btn-container">
                        @can('modifier service')
                            <a href="{{ url('services/'.$service->idS.'/edit') }}" class="btn btn-success">Modifier</a>
                        @endcan
                        @can('supprimer service')
                            <a href="{{ url('services/'.$service->idS.'/delete') }}" class="btn btn-danger">Supprimer</a>
                        @endcan
                        @can('voir projet')
                            <a href="{{ route('services.projets', $service->idS) }}" class="btn btn-info text-light">Projets</a>
                        @endcan
                        
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Dernière Modification: {{ Carbon::parse($service->updated_at)->format('d/m/Y') }}
                </div>
            </div>
        </div>
    </div>
@endsection