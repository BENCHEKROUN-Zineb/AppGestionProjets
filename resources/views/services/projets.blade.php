@extends('layouts.sidebar')

@php
    use Carbon\Carbon;
@endphp

@section('head-title')
    {{ $service->nomS }}
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
        <a class="active" href="#">Services</a>
    </li>
@endsection

@section('content')
    
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ route('services.show', $service->idS) }}" class="btn btn-primary">Retour</a>
    </div>

    {{-- <div class="d-flex justify-content-center mt-3">
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>Nom Projet</th>
                    <th style="width: 70%;">Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projets as $project)
                    <tr>
                        <td>{{ $project->nomP }}</td>
                        <td>{{ $project->descriptionP }}</td>
                        <td>
                            <a href="{{ url('projets/'.$project->id.'/edit') }}" class="btn btn-outline-success">Modifier</a>
                            <a href="{{ url('projets/'.$project->id.'/delete') }}" class="btn btn-outline-danger">Supprimer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}


    <div class="container">
        @foreach ($projets as $project)
            <div class="folder-card">
                <div class="icon"><i class='bx bxs-folder'></i></div>
                <div class="title">{{ $project->nomP }}</div>
                <div class="date">{{ Carbon::parse($project->updated_at)->format('d/m/Y') }}</div>
            </div>
        @endforeach
    </div>

@endsection
