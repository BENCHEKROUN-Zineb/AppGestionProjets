@extends('layouts.sidebar')

@section('head-title')
    Role : {{ $role->name }}
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Roles</a>
    </li>
    <li><i class='bx bx-chevron-right' ></i></li>
    <li>
        <a class="active" href="#">Modifier Role</a>
    </li>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('roles') }}" class="btn btn-primary">Retour</a>
    </div>

    <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">

            @error('permission')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="mb-3 text-center">
                <label for="selectAll" class="badge rounded-pill text-bg-light" style="font-weight: 100; font-size: 16px">
                    <input type="checkbox" id="selectAll" />
                    Sélectionner tout
                </label>
            </div>

            <div class="row">
                @foreach ($permissions as $permission)
                    <div class="col-md-3 mb-3">
                        <label for="" class="badge rounded-pill text-bg-light" style="font-weight: 100; font-size: 16px">
                            <input 
                                type="checkbox" 
                                name="permission[]" 
                                value="{{ $permission->name }}"
                                class="permission-checkbox"
                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                            />
                            {{$permission->name}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.permission-checkbox');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script>
@endsection


