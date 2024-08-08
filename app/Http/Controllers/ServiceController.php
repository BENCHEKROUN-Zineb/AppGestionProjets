<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Division;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct(){
        $this->middleware('permission:voir service', ['only' => ['index','show']]);
        $this->middleware('permission:ajouter service', ['only' => ['create','store']]);
        $this->middleware('permission:modifier service', ['only' => ['update','edit']]);
        $this->middleware('permission:supprimer service', ['only' => ['destroy']]);
        $this->middleware('permission:voir projet', ['only' => ['showProjects']]);
    }

    public function index(Request $request)
    {
        $searchTerm = $request->input('query');

        if ($searchTerm) {
            $services = Service::where('nomS', 'LIKE', '%' . $searchTerm . '%')
                               ->with('division') // Assurez-vous que la relation est chargée
                               ->get();
        } else {
            $services = Service::with('division')->get(); // Charger toutes les services si aucune recherche
        }

        return view('services.index', ['services' => $services]);
    }

    public function show($idS)
    {
        $service = Service::findOrFail($idS);
        $division = Service::with('division')->get();

        return view('services.show', [
            'service' => $service,
            'division' => $division
        ]);
    }

    public function showProjects(Service $service)
    {
        $projets = $service->projets; // Récupérer les projets du service
        return view('services.projets', [
            'service' => $service,
            'projets' => $projets
        ]);
    }

    public function create()
    {
        $divisions = Division::all(); // Récupérer toutes les divisions
        return view('services.create', [
            'divisions' => $divisions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomS' => 'required|string',
            'descriptionS' => 'required|string',
            'idD' => 'required|exists:divisions,idD', // Valider que idD existe dans divisions
        ]);

        Service::create([
            'nomS' => $request->nomS,
            'descriptionS' => $request->descriptionS,
            'idD' => $request->idD,
        ]);

        return redirect('services')->with('status', 'Service créé avec succès');
    }

    public function edit(Service $service)
    {
        $divisions = Division::all(); // Récupérer toutes les divisions pour la vue d'édition
        return view('services.edit', [
            'service' => $service,
            'divisions' => $divisions
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nomS' => 'required|string',
            'descriptionS' => 'required|string',
            'idD' => 'required|exists:divisions,idD', // Valider que idD existe dans divisions
        ]);

        $service->update([
            'nomS' => $request->nomS,
            'descriptionS' => $request->descriptionS,
            'idD' => $request->idD,
        ]);

        return redirect('services')->with('status', 'Service modifié avec succès');
    }

    public function destroy($serviceId)
    {
        $service = Service::find($serviceId);
        $service->delete();
        return redirect('services')->with('status','Service Supprimé avec succès');
    }
}
