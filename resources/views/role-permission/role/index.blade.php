@extends('layouts.sidebar')

@section('head-title')
    Roles
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Roles</a>
    </li>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @can('ajouter role')
        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="{{ url('roles/create') }}" class="btn btn-primary">Ajouter Role</a>
        </div>
    @endcan

    <div class="d-flex justify-content-center mt-3">
        <table id="myTable" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('modifier role')
                                <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-outline-success">Modifier</a>
                            @endcan
                            @can('supprimer role')
                                <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-outline-danger">Supprimer</a>
                            @endcan
                            @can('ajouter permissions pour rôle')
                                <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-outline-primary">Ajouter/Modifier les Permissions</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
