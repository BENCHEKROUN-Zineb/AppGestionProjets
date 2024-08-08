@extends('layouts.sidebar')

@section('head-title')
    Modfier Utilisateur
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Utilisateurs</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Modifier Utilisateur</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('users')}}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ url('users/'.$user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="">Nom Utilisateur :</label>
            <input type="text" name="name" value="{{$user->name}}" class="form-control">
            @error('name') <span class="text-danger">{{$message}}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="">Email Utilisateur :</label>
            <input type="text" name="email" value="{{$user->email}}" readonly class="form-control">
        </div>

        <div class="mb-3">
            <label for="">Mot de passe :</label>
            <input type="text" name="password" class="form-control">
            @error('password') <span class="text-danger">{{$message}}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="">Roles :</label>
            <select name="roles[]" class="form-control" multiple>
                <option value="" disabled>Selectionner les roles</option>
                @foreach ($roles as $role)
                    <option 
                        value="{{$role}}"
                        {{ in_array($role, $userRoles)? 'selected' : '' }}
                    >
                        {{$role}}
                    </option>
                @endforeach
            </select>
            @error('roles') <span class="text-danger">{{$message}}</span> @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
@endsection