<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('permission:voir utilisateur', ['only' => ['index']]);
        $this->middleware('permission:ajouter utilisateur', ['only' => ['create','store']]);
        $this->middleware('permission:modifier utilisateur', ['only' => ['update','edit']]);
        $this->middleware('permission:supprimer utilisateur', ['only' => ['destroy']]);
    }

    public function index(){
        $users = User::get();
        return view('role-permission.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('role-permission.user.create',[
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','Utilisateur crée avec succès');
    }

    public function edit(User $user)
    {
        $userRoles = $user->roles->pluck('name','name')->all();
        $roles = Role::pluck('name','name')->all();
        return view('role-permission.user.edit',[
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->password)) { //s'il n est pas vide ghdi yzid 7ta l password m3a les field lokhirn li modifié
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','Utilisateur Modifiè avec succès');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('/users')->with('status','Utilisateur Supprimè avec succès');
    }
}
