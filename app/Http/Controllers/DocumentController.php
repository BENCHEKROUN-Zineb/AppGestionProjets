<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use App\Imports\DocumentImport;

class DocumentController extends Controller
{
    public function __construct(){
        $this->middleware('permission:voir document', ['only' => ['index','show']]);
        $this->middleware('permission:ajouter document', ['only' => ['create','store']]);
        $this->middleware('permission:modifier document', ['only' => ['update','edit']]);
        $this->middleware('permission:supprimer document', ['only' => ['destroy']]);
        $this->middleware('permission:téléchargez document', ['only' => ['download']]);
    }
    public function index(Request $request)
    {
        $query = $request->input('query');
        $projetQuery = $request->input('projet_query');
    
        $documents = Document::with('projet')
            ->when($query, function ($q) use ($query) {
                return $q->where('nomD', 'like', "%$query%");
            })
            ->when($projetQuery, function ($q) use ($projetQuery) {
                return $q->whereHas('projet', function ($q) use ($projetQuery) {
                    $q->where('nomP', 'like', "%$projetQuery%");
                });
            })
            ->get();
    
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $projets = Projet::all();
        return view('documents.import', [
            'projets' => $projets
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomD' => 'required|string|max:255',
            'typeD' => 'required|string|max:255',
            'idP' => 'required|integer|exists:projets,idP',
            'excel_file' => 'required|file|mimes:xls,xlsx',
        ]);

        // Stocker le fichier Excel dans le dossier 'documents'
        $filePath = $request->file('excel_file')->store('documents');

        // Enregistrer les informations dans la base de données
        Document::create([
            'nomD' => $request->nomD,
            'typeD' => $request->typeD,
            'idP' => $request->idP,
            'file_path' => $filePath,
        ]);

        if ($request->redirectTo === 'projets.show') {
            return redirect()->route('projets.show', $request->idP)->with('success', 'Document Imported Successfully!');
        }

        return redirect()->route('documents.index')->with('success', 'Document Imported Successfully!');
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.show', compact('document'));
    }

    public function edit($id)
    {
        $projets = Projet::all();
        $document = Document::findOrFail($id);
        return view('documents.edit', [
            'document' => $document,
            'projets' => $projets
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomD' => 'required|string|max:255',
            'typeD' => 'required|string|max:255',
            'idP' => 'required|integer|exists:projets,idP',
            'excel_file' => 'nullable|file|mimes:xls,xlsx',
        ]);

        $document = Document::findOrFail($id);

        if ($request->hasFile('excel_file')) {
            // Supprimer l'ancien fichier
            if ($document->file_path) {
                Storage::delete($document->file_path);
            }

            // Stocker le nouveau fichier
            $filePath = $request->file('excel_file')->store('documents');
            $document->file_path = $filePath;
        }

        $document->nomD = $request->nomD;
        $document->typeD = $request->typeD;
        $document->idP = $request->idP;

        $document->save();

        return redirect()->route('documents.index')->with('success', 'Document modifié avec succès!');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // Supprimer le fichier
        Storage::delete($document->file_path);

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document Deleted Successfully!');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        $filePath = storage_path('app/' . $document->file_path);
        
        if (!Storage::exists($document->file_path)) {
            return redirect()->route('documents.index')->with('error', 'File not found.');
        }

        $fileName = $document->nomD . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION);

        return response()->download($filePath, $fileName);
    }

    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     $fileFilter = $request->input('file_filter');
    //     $results = [];
        
    //     // Récupérer tous les documents pour le filtre
    //     $allDocuments = Document::all();
    
    //     if ($query) {
    //         $documentsQuery = Document::query();
    
    //         if ($fileFilter) {
    //             $documentsQuery->where('idD', $fileFilter);
    //         }
    
    //         $documents = $documentsQuery->get();
    
    //         foreach ($documents as $document) {
    //             $path = storage_path('app/' . $document->file_path);
    
    //             if (file_exists($path)) {
    //                 try {
    //                     $data = Excel::toCollection(new DocumentImport, $path);
    
    //                     foreach ($data as $sheet) {
    //                         foreach ($sheet as $row) {
    //                             foreach ($row as $cell) {
    //                                 if (stripos($cell, $query) !== false) {
    //                                     $results[] = [
    //                                         'value' => $cell,
    //                                         'file_name' => $document->nomD . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION),
    //                                     ];
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 } catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $e) {
    //                     // Gérer l'erreur ici si nécessaire
    //                     return response()->json(['error' => 'Error processing file.'], 400);
    //                 }
    //             } else {
    //                 return response()->json(['error' => 'File does not exist.'], 404);
    //             }
    //         }
    //     }
    
    //     $totalResults = count($results);
    
    //     // Passer les documents pour le filtre à la vue
    //     return view('search', compact('results', 'totalResults', 'allDocuments'));
    // }
    
    

    public function search(Request $request)
{
    $query = $request->input('query');
    $fileFilter = $request->input('file_filter');
    $results = [];
    
    if ($query) {
        $documentsQuery = Document::query();
    
        if ($fileFilter) {
            $documentsQuery->where('idD', $fileFilter);
        }
    
        $documents = $documentsQuery->get();
    
        foreach ($documents as $document) {
            $path = storage_path('app/' . $document->file_path);
    
            if (file_exists($path)) {
                try {
                    $data = Excel::toCollection(new DocumentImport, $path);
                    $fileResults = [];
    
                    foreach ($data as $sheet) {
                        foreach ($sheet as $row) {
                            foreach ($row as $cell) {
                                if (stripos($cell, $query) !== false) {
                                    $fileResults[] = $row; // Ajouter la ligne complète contenant le résultat
                                }
                            }
                        }
                    }
    
                    if (!empty($fileResults)) {
                        $results[$document->nomD] = $fileResults; // Stocker les résultats par fichier
                    }
                } catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $e) {
                    return response()->json(['error' => 'Error processing file.'], 400);
                }
            } else {
                return response()->json(['error' => 'File does not exist.'], 404);
            }
        }
    }
    
    $totalResults = array_sum(array_map('count', $results));
    $allDocuments = Document::all();
    
    return view('search', compact('results', 'totalResults', 'allDocuments'));
}


}
