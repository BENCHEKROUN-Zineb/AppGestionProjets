<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    public function __construct(){
        $this->middleware('permission:voir partenaire', ['only' => ['index']]);
        $this->middleware('permission:ajouter partenaire', ['only' => ['create','store']]);
        $this->middleware('permission:modifier partenaire', ['only' => ['update','edit']]);
        $this->middleware('permission:supprimer partenaire', ['only' => ['destroy']]);
    }

    public function index()
    {
        $partenaires = Partenaire::all();
        return view('partenaires.index', [
            'partenaires' => $partenaires
        ]);
    }
    

    public function create()
    {
        return view('partenaires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomPa' => 'required|string',
            'contactPa' => 'required|string',
            'adressePa' => 'required|string',
        ]);

        Partenaire::create([
            'nomPa' => $request->nomPa,
            'contactPa' => $request->contactPa,
            'adressePa' => $request->adressePa,
        ]);

        return redirect('partenaires')->with('status', 'Partenaire créé avec succès');
    }

    public function edit(Partenaire $partenaire)
    {
        return view('partenaires.edit', [
            'partenaire' => $partenaire,
        ]);
    }

    public function update(Request $request, Partenaire $partenaire)
    {
        $request->validate([
            'nomPa' => 'required|string',
            'contactPa' => 'required|string',
            'adressePa' => 'required|string',
        ]);

        $partenaire->update([
            'nomPa' => $request->nomPa,
            'contactPa' => $request->contactPa,
            'adressePa' => $request->adressePa,
        ]);

        return redirect('partenaires')->with('status', 'Partenaires modifié avec succès');
    }

    public function destroy($partenaireId)
    {
        $partenaire = Partenaire::find($partenaireId);
        $partenaire->delete();
        return redirect('partenaires')->with('status','Partenaire Supprimé avec succès');
    }
}
