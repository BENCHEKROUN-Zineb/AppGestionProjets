@extends('layouts.sidebar')

@section('head-title')
    Modifier Permission
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a href="#">Permissions</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Modifier Permission : {{ $permission->name }}</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('permissions') }}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ url('permissions/'.$permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="">Nom Permission :</label>
            <input type="text" name="name" value="{{ $permission->name }}" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
@endsection 