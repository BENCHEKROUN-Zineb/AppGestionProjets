@extends('layouts.sidebar')

@section('head-title')
    Permissions
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Permissions</a>
    </li>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {{-- 
        @can('ajouter permission')
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a href="{{ url('permissions/create') }}" class="btn btn-primary">Ajouter permission</a>
            </div>
        @endcan
     --}}

    {{-- <div class="d-flex justify-content-center"> --}}
        {{-- <table id="example" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            @can('modifier permission')
                                <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-outline-success">Modifier</a>
                            @endcan

                            @can('supprimer permission')
                                <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="btn btn-outline-danger">Supprimer</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

        <div class="mb-3">
            <div class="row mt-4">
                @for ($i = 0; $i < count($permissions); $i += 4)
                    <div class="row mb-3">
                        @for ($j = $i; $j < $i + 4 && $j < count($permissions); $j++)
                            <div class="col-md-3">
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h6 class="card-title text-primary">{{ $permissions[$j]->name }}</h6>
                                        <!-- Ajoutez plus d'informations ici si nécessaire -->
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @endfor
            </div>
        </div>

    {{-- </div> --}}

@endsection
