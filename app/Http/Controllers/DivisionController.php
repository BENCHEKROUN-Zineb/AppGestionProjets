<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function __construct(){
        $this->middleware('permission:voir division', ['only' => ['index']]);
        $this->middleware('permission:ajouter division', ['only' => ['create','store']]);
        $this->middleware('permission:modifier division', ['only' => ['update','edit']]);
        $this->middleware('permission:supprimer division', ['only' => ['destroy']]);
        $this->middleware('permission:voir service', ['only' => ['show']]);
    }
    public function index(Request $request)
    {
        $searchTerm = $request->input('query');
    
        if ($searchTerm) {
            $divisions = Division::where('nomD', 'LIKE', '%' . $searchTerm . '%')->get();
        } else {
            $divisions = Division::all(); // Récupère toutes les divisions si aucune recherche
        }
    
        return view('division.index', ['divisions' => $divisions]);
    }

    public function show(Division $division)
    {
        $services = $division->services; // Récupérer les services de la division
        return view('division.details', [
            'division' => $division,
            'services' => $services
        ]); 
    }


    public function create()
    {
        return view('division.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomD' => 'required|string'
        ]);
    
        Division::create([
            'nomD' => $request->nomD
        ]);
    
        return redirect('divisions')->with('status', 'Division créée avec succès');
    }

    public function edit(Division $division)  //model permission
    {  
        return view('division.edit',[
            'division' => $division
        ]);
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'nomD' => 'required|string'
        ]);

        $division->update([
            'nomD' => $request->nomD
        ]);

        return redirect('divisions')->with('status', 'Division modifiée avec succès');
    }

    public function destroy($divisionId)
    {
        $division = Division::find($divisionId);
        $division->delete();
        return redirect('divisions')->with('status','Division Supprimé avec succès');
    }

    
}
