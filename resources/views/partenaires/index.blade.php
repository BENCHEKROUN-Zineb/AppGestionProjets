@extends('layouts.sidebar')

@section('head-title')
    Partenaires
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Partenaires</a>
    </li>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @can('ajouter partenaire')
        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="{{ url('partenaires/create') }}" class="btn btn-primary">Ajouter Partenaire</a>
        </div> 
    @endcan


    <div class="d-flex justify-content-center mt-3">
        <table id="myTable" class="table table-hover align-middle" style="width:100%">
            <thead>
                <tr>
                    <th>Nom Partenaire</th>
                    <th>Contact Partenaire</th>
                    <th>Adresse Partenaire</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($partenaires as $partenaire)
                    <tr>
                        <td>{{ $partenaire->nomPa }}</td>
                        <td>{{ $partenaire->contactPa }}</td>
                        <td>{{ $partenaire->adressePa }}</td>
                        <td>
                            @can('modifier partenaire')
                                <a href="{{ url('partenaires/'.$partenaire->idpa.'/edit') }}" class="btn btn-outline-success">Modifier</a>
                            @endcan
                            @can('supprimer partenaire')
                                <a href="{{ url('partenaires/'.$partenaire->idpa.'/delete') }}" class="btn btn-outline-danger">Supprimer</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
