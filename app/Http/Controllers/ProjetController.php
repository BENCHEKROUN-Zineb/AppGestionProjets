<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Partenaire;
use App\Models\Projet;
use App\Models\Service;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function __construct(){
        $this->middleware('permission:voir projet', ['only' => ['index','show']]);
        $this->middleware('permission:ajouter projet', ['only' => ['create','store']]);
        $this->middleware('permission:modifier projet', ['only' => ['update','edit']]);
        $this->middleware('permission:supprimer projet', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $searchTerm = $request->input('query');

        if ($searchTerm) {
            $projets = Projet::where('nomP', 'LIKE', '%' . $searchTerm . '%')
                             ->with('service') // Assurez-vous que la relation est chargée si nécessaire
                             ->get();
        } else {
            $projets = Projet::with('service')->get(); // Charger tous les projets si aucune recherche
        }

        return view('projets.index', ['projets' => $projets]);
    }

    public function show($idP)
    {
        $projet = Projet::findOrFail($idP);
        $documents = Document::where('idP', $idP)->get();

        return view('projets.show', [
            'projet' => $projet,
            'documents' => $documents
        ]);
    }

    public function create()
    {
        $services = Service::all(); // Récupérer tous les services
        $partenaires = Partenaire::all(); // Récupérer tous les partenaires
        
        return view('projets.create', [
            'services' => $services,
            'partenaires' => $partenaires // Passer les partenaires à la vue
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nomP' => 'required|string',
            'descriptionP' => 'required|string',
            'idS' => 'required|exists:services,idS',
            'idpa' => 'array|exists:partenaires,idpa'
        ]);        
    
        $projet = Projet::create([
            'nomP' => $request->nomP,
            'descriptionP' => $request->descriptionP,
            'idS' => $request->idS,
        ]);
    
        if ($request->has('idpa')) {
            $projet->partenaires()->sync($request->idpa);
        }
    
        return redirect()->route('projets.index')->with('status', 'Projet créé avec succès');
    }
    

    public function edit(Projet $projet)
    {
        $services = Service::all(); // Récupérer tous les services
        $partenaires = Partenaire::all(); // Récupérer tous les partenaires
        
        return view('projets.edit', [
            'projet' => $projet,
            'services' => $services,
            'partenaires' => $partenaires // Passer les partenaires à la vue
        ]);
    }
    
    

    public function update(Request $request, Projet $projet)
    {
        $request->validate([
            'nomP' => 'required|string',
            'descriptionP' => 'required|string',
            'idS' => 'required|exists:services,idS',
            'idpa' => 'nullable|array',
            'idpa.*' => 'exists:partenaires,idpa'
        ]);
    
        $projet->update([
            'nomP' => $request->nomP,
            'descriptionP' => $request->descriptionP,
            'idS' => $request->idS,
        ]);
    
        // if ($request->has('idpa')) {
        //     $projet->partenaires()->sync($request->idpa);
        // } else {
        //     $projet->partenaires()->detach();
        // }


        if ($request->has('idpa')) {
            // Ensure there are no duplicate entries
            $newPartnerIds = array_unique($request->idpa);
            $currentPartnerIds = $projet->partenaires->pluck('idpa')->toArray();
    
            // Calculate partners to be added and removed
            $partnersToAdd = array_diff($newPartnerIds, $currentPartnerIds);
            $partnersToRemove = array_diff($currentPartnerIds, $newPartnerIds);
    
            // Attach new partners
            foreach ($partnersToAdd as $partnerId) {
                $projet->partenaires()->attach($partnerId);
            }
    
            // Detach removed partners
            foreach ($partnersToRemove as $partnerId) {
                $projet->partenaires()->detach($partnerId);
            }
        } else {
            // If no partners are selected, detach all current partners
            $projet->partenaires()->detach();
        }
    
        return redirect()->route('projets.index')->with('status', 'Projet modifié avec succès');
    }
    
    
    public function destroy($projetId)
    {
        $projet = Projet::find($projetId);
        $projet->delete();
        return redirect('projets')->with('status','Projet Supprimé avec succès');
    }
}
