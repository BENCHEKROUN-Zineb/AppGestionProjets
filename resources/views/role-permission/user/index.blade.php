@extends('layouts.sidebar')

@section('head-title')
    Utilisateurs
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Utilisateurs</a>
    </li>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @can('ajouter utilisateur')
        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="{{ url('users/create') }}" class="btn btn-primary">Ajouter Utilisateur</a>
        </div>
    @endcan

    <div class="d-flex justify-content-center">
        <table id="myTable" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $rolename)
                                    <label class="badge bg-primary mx-1">{{$rolename}}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @can('modifier utilisateur')
                                <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-outline-success">Modifier</a>
                            @endcan
                            @can('supprimer utilisateur')
                                <a href="{{ url('users/'.$user->id.'/delete') }}" class="btn btn-outline-danger">Supprimer</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
