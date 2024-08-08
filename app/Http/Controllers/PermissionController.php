<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware('permission:voir permission', ['only' => ['index']]);
        $this->middleware('permission:ajouter permission', ['only' => ['create','store']]);
        $this->middleware('permission:modifier permission', ['only' => ['update','edit']]);
        $this->middleware('permission:supprimer permission', ['only' => ['destroy']]);
    }

    public function index(){
        $permissions = Permission::get(); //get all permissions
        return view('role-permission.permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function create(){
        return view('role-permission.permission.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status','Permission créée avec succès');
    }

    public function edit(Permission $permission){   //model permission


        return view('role-permission.permission.edit',[
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission){
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status','Permission Modifiée avec succès');
    }

    public function destroy($permissionId){
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status','Permission Supprimée avec succès');
    }
}
