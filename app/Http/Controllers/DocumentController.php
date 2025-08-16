<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Notifications\DocumentPublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class DocumentController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage', Document::class);
        
        $documents = Document::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manage', Document::class);
        
        $documentTypes = [
            'Notes de service',
            'Guides',
            'Manuels de procédures',
            'Textes réglementaires et législatifs',
            'Tarifs',
            'Supports de formation',
            'Organigrammes et répertoire interne',
            'Politiques et chartes internes'
        ];

        return view('documents.create', compact('documentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage', Document::class);
        
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:Notes de service,Guides,Manuels de procédures,Textes réglementaires et législatifs,Tarifs,Supports de formation,Organigrammes et répertoire interne,Politiques et chartes internes',
            'fichier' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240', 
        ]);

        $file = $request->file('fichier');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');

        $document = Document::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'type' => $request->type,
            'fichier' => $fileName,
            'extension' => $file->getClientOriginalExtension(),
            'taille' => $file->getSize(),
            'chemin_fichier' => $filePath,
            'user_id' => Auth::id(),
            'est_public' => true,
            'date_publication' => now(),
        ]);

        $users = User::where('est_bloque', false)->get();
        foreach ($users as $user) {
            if ($user->id !== Auth::id()) {
                $user->notify(new DocumentPublished($document));
            }
        }

        return redirect()->route('documents.index')
            ->with('success', 'Document publié avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $this->authorize('view', $document);
        
        return view('documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        $this->authorize('manage', Document::class);
        
        $documentTypes = [
            'Notes de service',
            'Guides',
            'Manuels de procédures',
            'Textes réglementaires et législatifs',
            'Tarifs',
            'Supports de formation',
            'Organigrammes et répertoire interne',
            'Politiques et chartes internes'
        ];

        return view('documents.edit', compact('document', 'documentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $this->authorize('manage', Document::class);
        
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:Notes de service,Guides,Manuels de procédures,Textes réglementaires et législatifs,Tarifs,Supports de formation,Organigrammes et répertoire interne,Politiques et chartes internes',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240',
        ]);

        $data = [
            'titre' => $request->titre,
            'description' => $request->description,
            'type' => $request->type,
        ];

        if ($request->hasFile('fichier')) {
            // Supprimer l'ancien fichier
            if ($document->chemin_fichier) {
                Storage::disk('public')->delete($document->chemin_fichier);
            }

            $file = $request->file('fichier');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('documents', $fileName, 'public');

            $data['fichier'] = $fileName;
            $data['extension'] = $file->getClientOriginalExtension();
            $data['taille'] = $file->getSize();
            $data['chemin_fichier'] = $filePath;
        }

        $document->update($data);

        return redirect()->route('documents.index')
            ->with('success', 'Document mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $this->authorize('manage', Document::class);
        
        // Supprimer le fichier
        if ($document->chemin_fichier) {
            Storage::disk('public')->delete($document->chemin_fichier);
        }

        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Document supprimé avec succès !');
    }

    /**
     * View document without download
     */
    public function view(Document $document)
    {
        $this->authorize('view', Document::class);
        
        return view('documents.view', compact('document'));
    }
}
