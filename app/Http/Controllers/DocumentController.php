<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->route()->getName() === 'documents.export.csv' || 
                $request->route()->getName() === 'documents.export.pdf') {
                $user = Auth::user();
                if (!$user || !in_array($user->role, ['admin', 'rh'])) {
                    abort(403, 'Accès non autorisé. Seuls les administrateurs et les RH peuvent exporter des documents.');
                }
            }
            return $next($request);
        });
    }

    public function index()
    {
        $documents = Document::with('user')->paginate(15);
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'fichier' => 'required|file|mimes:pdf,doc,docx,txt|max:10240',
            'est_public' => 'boolean'
        ]);

        $path = $request->file('fichier')->store('documents', 'public');
        $taille = $request->file('fichier')->getSize();

        $document = Document::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'chemin_fichier' => $path,
            'taille' => $taille,
            'est_public' => $validated['est_public'] ?? true,
            'user_id' => Auth::id(),
            'date_publication' => now(),
        ]);

        return redirect()->route('documents.index')->with('success', 'Document créé avec succès.');
    }

    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'est_public' => 'boolean'
        ]);

        $document->update($validated);

        return redirect()->route('documents.index')->with('success', 'Document mis à jour avec succès.');
    }

    public function destroy(Document $document)
    {
        if (Storage::disk('public')->exists($document->chemin_fichier)) {
            Storage::disk('public')->delete($document->chemin_fichier);
        }
        
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document supprimé avec succès.');
    }

    public function view(Document $document)
    {
        return view('documents.view', compact('document'));
    }

    public function exportCsv(Request $request)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['admin', 'rh'])) {
            abort(403, 'Accès non autorisé. Seuls les administrateurs et les RH peuvent exporter des documents.');
        }

        $query = Document::query()
            ->with('user')
            ->where('est_public', true)
            ->orderBy('date_publication', 'desc');

        // Appliquer les filtres de recherche
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->selectedType) {
            $query->where('type', $request->selectedType);
        }

        $documents = $query->get();

        $filename = 'documents_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($documents) {
            $file = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($file, [
                'Titre',
                'Description',
                'Type',
                'Auteur',
                'Date de publication',
                'Taille (octets)',
                'Public'
            ]);

            // Données
            foreach ($documents as $document) {
                fputcsv($file, [
                    $document->titre,
                    $document->description ?? '',
                    $document->type,
                    $document->user->name ?? 'N/A',
                    $document->date_publication->format('d/m/Y H:i:s'),
                    $document->taille,
                    $document->est_public ? 'Oui' : 'Non'
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['admin', 'rh'])) {
            abort(403, 'Accès non autorisé. Seuls les administrateurs et les RH peuvent exporter des documents.');
        }

        $query = Document::query()
            ->with('user')
            ->where('est_public', true)
            ->orderBy('date_publication', 'desc');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->selectedType) {
            $query->where('type', $request->selectedType);
        }

        $documents = $query->get();

        $pdf = PDF::loadView('exports.documents-pdf', [
            'documents' => $documents,
            'search' => $request->search,
            'selectedType' => $request->selectedType,
            'exportDate' => now()->format('d/m/Y H:i:s')
        ]);

        $filename = 'documents_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }
}
