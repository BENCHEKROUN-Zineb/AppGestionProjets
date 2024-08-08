@extends('layouts.sidebar')

@php
    use Carbon\Carbon;
@endphp

@section('head-title')
    Projets
@endsection 

@section('style')
    <style type="text/css">
        .folder-card {
            width: 14%;
            height: 123px;
            background-color: #d3d3d3;
            border-radius: 10px;
            padding: 10px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .folder-card .icon {
            font-size: 30px;
            color: orange;
        }

        .folder-card .badge {
            background-color: #316ce0;
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-weight: lighter;
            font-size: 14px;
            position: absolute;
            top: 85px;
            left: 10px;
        }

        .folder-card .title {
            font-weight: lighter;
            font-size: 14px;
        }

        .folder-card .date {
            font-size: 10px;
            color: rgb(58, 56, 56);
        }

        .folder-card .dropdown {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border: none;
        }

        .folder-card:hover {
            background-color: #bfbfbf;
        }

        .folder-link {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: space-around;
            height: 100%;
            cursor: pointer;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        @media (max-width: 1200px) {
            .folder-card {
                width: 24%; /* 4 cards per row */
            }
        }

        @media (max-width: 992px) {
            .folder-card {
                width: 32%; /* 3 cards per row */
            }
        }

        @media (max-width: 768px) {
            .folder-card {
                width: 48%; /* 2 cards per row */
            }
        }

        @media (max-width: 576px) {
            .folder-card {
                width: 98%; /* 1 card per row */
            }
        }
    </style>
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Projets</a>
    </li>
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="containerr mt-3">
        <div class="row">
            <div id="search" class="d-flex justify-content-between align-items-center mb-3">
                <form action="{{ url('projets') }}" method="GET" class="d-flex" style="flex-grow: 1; max-width: 400px;">
                    <div class="form-input" style="flex-grow: 1;">
                        <input type="search" name="query" placeholder="Chercher..." value="{{ request('query') }}">
                        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>                    
                    </div>
                </form>
                @can('ajouter projet')
                    <a href="{{ url('projets/create') }}" class="btn btn-primary">Ajouter Projet</a>
                @endcan
            </div>
        </div>
    </div>

    <div class="container">
        @foreach ($projets as $projet)
            <div class="folder-card">
                <a href="{{ route('projets.show', $projet->idP) }}" class="folder-link">
                    <div class="icon"><i class='bx bxs-folder'></i></div>
                    <div class="title">{{ $projet->nomP }}</div>
                    <div class="date">{{ Carbon::parse($projet->updated_at)->format('d/m/Y') }}</div>
                </a>
                <div class="dropdown">
                    <button class="btn btn-link" type="button" id="dropdownMenuButton{{ $projet->idP }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-dots-vertical-rounded' style='color:#0d0d0d'></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $projet->idP }}">
                        @can('voir projet')
                            <li><a href="{{ route('projets.show', $projet->idP) }}" class="dropdown-item">Show</a></li>
                        @endcan
                        @can('modifier projet')
                            <li><a href="{{ url('projets/'.$projet->idP.'/edit') }}" class="dropdown-item">Modifier</a></li>
                        @endcan
                        @can('supprimer projet')
                            <li><a href="{{ url('projets/'.$projet->idP.'/delete') }}" class="dropdown-item text-danger">Supprimer</a></li>
                        @endcan
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
