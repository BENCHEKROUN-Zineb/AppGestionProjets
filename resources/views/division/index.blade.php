@extends('layouts.sidebar')

@section('head-title')
    Divisions
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Divisions</a>
    </li>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="container mt-3">
        <div class="row">
            <div id="search" class="d-flex justify-content-between align-items-center mb-3">
                <form action="{{ url('divisions') }}" method="GET" class="d-flex" style="flex-grow: 1; max-width: 400px;">
                    <div class="form-input" style="flex-grow: 1;">
                        <input type="search" name="query" placeholder="Chercher..." value="{{ request('query') }}">
                        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                    </div>
                </form>
                @can('ajouter division')
                    <a href="{{ url('divisions/create') }}" class="btn btn-primary ml-3">Ajouter Division</a>
                @endcan
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <table id="example" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nom Division</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($divisions->isEmpty())
                    <tr>
                        <td colspan="2" class="text-center">Aucune division trouvée</td>
                    </tr>
                @else
                    @foreach ($divisions as $division)
                        <tr>
                            <td>{{ $division->nomD }}</td>
                            <td>
                                @can('voir service')
                                    <a href="{{ route('divisions.details', $division->idD) }}" class="btn btn-outline-secondary">Services</a>
                                @endcan
                                @can('modifier division')
                                    <a href="{{ url('divisions/'.$division->idD.'/edit') }}" class="btn btn-outline-success">Modifier</a>
                                @endcan
                                @can('supprimer division')
                                    <a href="{{ url('divisions/'.$division->idD.'/delete') }}" class="btn btn-outline-danger">Supprimer</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection
